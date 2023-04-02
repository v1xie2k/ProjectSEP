<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\KategoriMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class HomePageController extends Controller
{
    public function CariMenu(Request $r){
        $menu = Menu::where('name','LIKE', '%'.$r->search.'%')->where('id_kategori','=',$r->id)->get();
        // $menu = Menu::where('name','LIKE', 'Indomie')->where('id_kategori','=',2)->get();
        return response()->json($menu);
    }

    public function CariMenuPrice(Request $r){
        if($r->search == "1"){
            $menu = Menu::where('harga','<', 20000)->where('id_kategori','=',$r->id)->get();
        }
        else if($r->search == "2"){
            $menu = Menu::where('harga','>', 19999)->where('harga','<', 39999)->where('id_kategori','=',$r->id)->get();
        }
        else if($r->search == "3"){
            $menu = Menu::where('harga','>', 39999)->where('id_kategori','=',$r->id)->get();
        }
        else{
            $menu = Menu::where('id_kategori','=',$r->id)->get();
        }

        // $menu = Menu::where('name','LIKE', 'Indomie')->where('id_kategori','=',2)->get();
        return response()->json($menu);
    }
    public function home(Request $request)
    {
        Session::forget('categoriesPicts');
        $categories = KategoriMenu::all();
        $pict = Storage::disk('public')->files("categories");
        Session::forget('categoriesPicts');
        foreach($pict as $val)
        {
            Session::push('categoriesPicts', pathinfo($val)["basename"]);
        }
        $picts = Session::get('categoriesPicts');
        // dd($picts);
        return view('client.menu.listcategory',compact('categories','picts'));
    }
    public function listitems(Request $request)
    {
        Session::forget('picts');
        $id = $request->id;
        $category = KategoriMenu::find($request->id);
        $items = Menu::where('id_kategori',$request->id)->orderBy('name','asc')->get();
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
        return view('client.menu.listitems',compact('category','items','picts','id'));
    }
    public function addToCart(Request $request)
    {
        $item = Menu::find($request->id);
        // $cart = Cart::find(getYangLogin()->id);
        $cart = DB::table('cart')->where('id_user', getYangLogin()->id)->where('id_menu',$request->id)->get();
        if(count($cart) == 0){
            //kalau item belum ada di cart maka di add
            $data =[];
            $data['id_menu'] = $request->id;
            $data['id_user'] = getYangLogin()->id;
            $data['name_menu'] = $item->name;
            $data['price'] = $item->harga;
            $data['quantity'] = 1;
            $data['subtotal'] = $data['quantity'] * $data['price'];
            if(Cart::create($data))
            {
                return redirect()->back()->with(['pesan' => ['tipe' => 1, 'isi' => 'Success add to cart']]);
            }
            return redirect()->back()->with(['pesan' => ['tipe' => 0, 'isi' => 'Failed add to cart']]);
        }else{
            $qty = $cart[0]->quantity += 1;
            $subtotal = $cart[0]->subtotal = $cart[0]->price * $cart[0]->quantity;
            $updateCart = DB::table('cart')->where('id_user', getYangLogin()->id)->where('id_menu',$request->id)->update(['quantity'=>$qty , 'subtotal'=>$subtotal]);
            //dd(Session::get('cart'));
            return redirect()->back()->with(['pesan' => ['tipe' => 1, 'isi' => 'Success add to cart']]);
            // dd($updateCart);
            //error karena pake dbraw maka ga bisa pake syntax update
            // $cart[0]->quantity += 1;
            // $cart[0]->subtotal = $cart[0]->price * $cart[0]->quantity;
            // // $cart->update($cart[0]);
            // $cart->update($cart);
        }
    }

}
