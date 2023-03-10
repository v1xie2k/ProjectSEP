<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Cart;
use App\Models\Dtrans;
use App\Models\Ekspedisi;
use App\Models\Htrans;
use App\Models\Menu;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        $carts = Cart::where('id_user',getYangLogin()->id)->get();
        $totalPrice = 0;
        $saldo = getYangLogin()->saldo;
        foreach($carts as $val){
            // dump($val->subtotal);
            $totalPrice += $val->subtotal;
        }
        $ekspedisi = Ekspedisi::find($request->id_ekspedisi);
        $totalPrice += $ekspedisi->ongkir;
        if(count($carts) != 0)
        {
            if($saldo < $totalPrice)
            {
                return redirect()->back()->with(['msg'=>['isi'=>'Not Enough Balance','type'=>0]]);
            }else{
                $data = $request->all();
                $data['total'] += $ekspedisi->ongkir;
                $htrans = Htrans::create($data);
                foreach($carts as $val)
                {
                    $temp = [];
                    $temp['id_htrans'] = $htrans->id;
                    $temp['id_menu'] = $val->id_menu;
                    $temp['name_menu'] = $val->name_menu;
                    $temp['price'] = $val->price;
                    $temp['quantity'] = $val->quantity;
                    $temp['subtotal'] = $val->subtotal;
                    Dtrans::create($temp);
                    Cart::where('id_user',getYangLogin()->id)->where('id_menu',$val->id_menu)->delete();
                }
                $saldo = getYangLogin()->saldo - $data['total'];
                Users::find(getYangLogin()->id)->update(['saldo'=>$saldo]);
                $items = Dtrans::where('id_htrans',$htrans->id)->get();
                $user = getYangLogin();
                // return new InvoiceMail($items, $htrans->created_at);
                Mail::to(getYangLogin()->email)->send(new InvoiceMail($items, $htrans->created_at));
                return redirect()->back()->with(['msg'=>['isi'=>'Transaction Success','type'=>1]]);
            }
        }
        else{
            return redirect()->back()->with(['msg'=>['isi'=>'Your Cart is Empty','type'=>0]]);
            // return redirect()->back()->with(['msg'=>['isi'=>'You dont have any items to checkout','type'=>0]]);
        }
    }
}
