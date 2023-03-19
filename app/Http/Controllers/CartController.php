<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Dtrans;
use App\Models\Ekspedisi;
use App\Models\Htrans;
use App\Models\LogTransaksi;
use App\Models\Menu;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Sawirricardo\Midtrans\Dto\TransactionDto;
use Sawirricardo\Midtrans\Laravel\Facades\Midtrans;

class CartController extends Controller
{
    public function home(Request $request)
    {
        $carts = Cart::where('id_user', getYangLogin()->id)->get();
        $ekspedisis = Ekspedisi::all();
        Session::forget('picts');
        $pict = Storage::disk('public')->files("items");

        foreach($pict as $val)
        {
            $data = [];
            $data['filename'] = pathinfo($val)["basename"];
            $data['name'] = explode('.',pathinfo($val)["basename"])[0];
            $data['ext'] = '.'.explode('.',pathinfo($val)["basename"])[1];
            Session::push('picts', pathinfo($val)["basename"]);
        }
        $picts = Session::get('picts');
        return view('client.cart.cart',compact('carts','picts','ekspedisis'));
    }
    public function decreaseCart(Request $request)
    {
        $cart = Cart::where('id_menu',$request->id)->where('id_user',getYangLogin()->id)->get();
        $qty = $cart[0]->quantity -= 1;
        $subtotal = $cart[0]->subtotal = $cart[0]->price * $cart[0]->quantity;
        if($qty != 0)
        {
            Cart::where('id_menu',$request->id)->where('id_user',getYangLogin()->id)->update(['quantity' => $qty, 'subtotal' => $subtotal]);
        }else{
            Cart::where('id_menu',$request->id)->where('id_user',getYangLogin()->id)->delete();
        }
        return redirect()->back();
    }
    public function increaseCart(Request $request)
    {
        $cart = Cart::where('id_menu',$request->id)->where('id_user',getYangLogin()->id)->get();
        $qty = $cart[0]->quantity += 1;
        $subtotal = $cart[0]->subtotal = $cart[0]->price * $cart[0]->quantity;
        Cart::where('id_menu',$request->id)->where('id_user',getYangLogin()->id)->update(['quantity' => $qty, 'subtotal' => $subtotal]);
        return redirect()->back();
    }
    public function deleteItem(Request $request)
    {
        Cart::where('id_menu',$request->id)->where('id_user',getYangLogin()->id)->delete();

        return redirect()->back();
    }
    public function transaction(Request $request)
    {
        // $carts = Cart::where('id_user',getYangLogin()->id)->get();
        // $totalPrice = 0;
        // $saldo = getYangLogin()->saldo;
        // foreach($carts as $val){
        //     // dump($val->subtotal);
        //     $totalPrice += $val->subtotal;
        // }
        // $ekspedisi = Ekspedisi::find($request->id_ekspedisi);
        // $totalPrice += $ekspedisi->ongkir;
        // if(count($carts) != 0)
        // {
            // if($saldo < $totalPrice)
            // {
            //     return redirect()->back()->with(['msg'=>['isi'=>'Not Enough Balance','type'=>0]]);
            // }else{
            //     $data = $request->all();
            //     $data['total'] += $ekspedisi->ongkir;
            //     $htrans = Htrans::create($data);
            //     foreach($carts as $val)
            //     {
            //         $temp = [];
            //         $temp['id_htrans'] = $htrans->id;
            //         $temp['id_menu'] = $val->id_menu;
            //         $temp['name_menu'] = $val->name_menu;
            //         $temp['price'] = $val->price;
            //         $temp['quantity'] = $val->quantity;
            //         $temp['subtotal'] = $val->subtotal;
            //         Dtrans::create($temp);
            //         Cart::where('id_user',getYangLogin()->id)->where('id_menu',$val->id_menu)->delete();
            //     }
            //     $saldo = getYangLogin()->saldo - $data['total'];
            //     Users::find(getYangLogin()->id)->update(['saldo'=>$saldo]);
            //     $items = Dtrans::where('id_htrans',$htrans->id)->get();
            //     $user = getYangLogin();
            //     // return new InvoiceMail($items, $htrans->created_at);
            //     Mail::to(getYangLogin()->email)->send(new InvoiceMail($items, $htrans->created_at));
            //     return redirect()->back()->with(['msg'=>['isi'=>'Transaction Success','type'=>1]]);
            // }
            \Midtrans\Config::$serverKey = 'SB-Mid-server-J4G6KFZ9W319M3sr4rmrF37U';
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $data = $request->all();
            // dd($data);

            $snapToken = null;

            try {
                $carts = json_decode($request->item);
                $ekspedisi = json_decode($request->ekspedisi);
                $htrans = json_decode($request->htrans);
                $user = getYangLogin();
                $totalPurchase = $htrans->total;
                // dd($htrans->total);
                $item = [];
                foreach($carts as $val)
                {

                    $temp = [];
                    $temp = array(
                        'id'=> $val->id_menu,
                        "name"=> $val->name_menu,
                        "price"=> $val->price,
                        "quantity"=> $val->quantity,
                    );
                    array_push($item, $temp);
                }
                $temp = array(
                    'id'=> $ekspedisi->id,
                    "name"=> $ekspedisi->name,
                    "price"=> $ekspedisi->ongkir,
                    "quantity"=> 1,
                );
                array_push($item, $temp);

                $params = array(
                    'transaction_details' => array(
                        'order_id' => uniqid(),
                        'gross_amount' => $totalPurchase ,
                    ),
                    'item_details' => $item,
                    'customer_details' => array(
                        'first_name' => $user->name,
                        'last_name' => $user->name,
                        'email' => $user->email,
                        'phone' => '08111222333',
                    ),
                );
                $snapToken = Snap::getSnapToken($params);
                $data['token'] = $snapToken;
                Htrans::where('id',$htrans->id)->update(['token' => $snapToken]);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            return view('client.cart.paymentPage',compact('snapToken','htrans'));
        // }
        // else{
        //     return redirect()->back()->with(['msg'=>['isi'=>'Your Cart is Empty','type'=>0]]);
        // }
    }
    public function callbackMidtrans(Request $request)
    {
        $callback = $request->input('midtrans-callback');
        $temp = [];
        $callback = json_decode($callback);
        $temp['status_code'] = $callback->status_code;
        $temp['transaction_id'] = $callback->transaction_id;
        $temp['order_id'] = $callback->order_id;
        $temp['gross_amount'] = $callback->gross_amount;
        $temp['payment_type'] = $callback->payment_type;
        $temp['transaction_time'] = $callback->transaction_time;
        $temp['pdf_url'] = $callback->pdf_url;
        if($callback->va_numbers){
            var_dump($callback->va_numbers[0]->bank);
            $temp['bank'] = $callback->va_numbers[0]->bank;
        }

        LogTransaksi::create($temp);
        return redirect('home');
    }
    public function transactionProcess(Request $request)
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-J4G6KFZ9W319M3sr4rmrF37U';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $carts = Cart::where('id_user',getYangLogin()->id)->get();
        if(count($carts) != 0)
        {
            $totalPrice = 0;
            foreach($carts as $val){
                $totalPrice += $val->subtotal;
            }
            $ekspedisi = Ekspedisi::find($request->id_ekspedisi);
            $totalPrice += $ekspedisi->ongkir;

            $data = $request->all();
            $data['total'] += $ekspedisi->ongkir;
            //status untuk htrans
            // 0  declined
            // 1 pending
            // 100 success
            $data['status_trans'] = 1;

            try {
                $item = [];
                $htrans = Htrans::create($data);
                foreach($carts as $val)
                {
                    $dtransTemp = [];
                    $dtransTemp['id_htrans'] = $htrans->id;
                    $dtransTemp['id_menu'] = $val->id_menu;
                    $dtransTemp['name_menu'] = $val->name_menu;
                    $dtransTemp['price'] = $val->price;
                    $dtransTemp['quantity'] = $val->quantity;
                    $dtransTemp['subtotal'] = $val->subtotal;
                    $temp = [];
                    $temp = array(
                        'id'=> $val->id_menu,
                        "name"=> $val->name_menu,
                        "price"=> $val->price,
                        "quantity"=> $val->quantity,
                    );
                    array_push($item, $temp);
                    Dtrans::create($dtransTemp);
                    Cart::where('id_user',getYangLogin()->id)->where('id_menu',$val->id_menu)->delete();
                }
                $temp = array(
                    'id'=> $ekspedisi->id,
                    "name"=> $ekspedisi->name,
                    "price"=> $ekspedisi->ongkir,
                    "quantity"=> 1,
                );
                array_push($item, $temp);
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
            $items = Dtrans::where('id_htrans',$htrans->id)->get();
            new InvoiceMail($items, $htrans->created_at);

            Mail::to(getYangLogin()->email)->send(new InvoiceMail($items, $htrans->created_at));
            return redirect('home/cart/transaction/'.$htrans->id)->with(['htrans'=>$htrans,'item'=>$item]);
            // return view('client.cart.paymentPage',compact('snapToken','htrans'));
        }
        else{
            return redirect()->back()->with(['msg'=>['isi'=>'Your Cart is Empty','type'=>0]]);
        }
    }
    public function transactionTemplate(Request $request)
    {
        $htrans = Htrans::where('id','=',(int)$request->id)->get();
        $item = Dtrans::where('id_htrans','=', (int)$request->id)->get();
        $ekspedisi = Ekspedisi::where('id','=', $htrans[0]->id_ekspedisi)->get();
        $htrans = $htrans[0];
        $ekspedisi = $ekspedisi[0];
        return view('client.cart.transactionPage',compact('htrans','item','ekspedisi'));
    }
}
