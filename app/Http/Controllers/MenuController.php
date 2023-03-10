<?php

namespace App\Http\Controllers;

use App\Models\KategoriMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class MenuController extends Controller
{
    public function home(Request $request)
    {
        // $menus = Menu::get();
        $categories = KategoriMenu::get();
        return view('master.Items.home',compact('categories'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $item = Menu::where('id',$id)->get();
        $categories = KategoriMenu::get();
        $item = $item[0];
        return view('master.Items.edit',compact('item','categories'));
    }

    public function docreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'photo' => 'required|mimes:jpg|max:10000',
            'deskripsi' => 'required',
            'harga' => 'required|numeric'
        ]);
        $data = $request->all();
        $id = Menu::create($data);
        if($id){
            $namaFile = $id->id.".".$request->file("photo")->getClientOriginalExtension();
            $path = $request->file("photo")->storeAs("items", $namaFile, "public");
            return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Berhasil insert']);
        }
        else{
            return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal insert']);
        }
    }
    public function detail(Request $request)
    {
        $menu = Menu::find($request->id);
        $categories = KategoriMenu::get();
        $pict = Storage::disk('public')->files("items");
        for ($i=0; $i < count($pict); $i++) {
            if(pathinfo($pict[$i])["filename"] == $request->id){
                $picture = pathinfo($pict[$i])["basename"];
            }
        }
        return view('master.Items.detail',compact('menu', 'categories', 'picture'));
    }
    public function doedit(Request $request)
    {
        $menu = Menu::find($request->id);
        $validated = $request->validate([
            'name' => 'required',
            'photo' => 'mimes:jpg|max:10000',
            'deskripsi' => 'required',
            'harga' => 'required|numeric'
        ]);
        $data = $request->all();
        if($request->photo != null){
            // dd($request->pict);
            Storage::disk('public')->delete('items/'.$request->pict);
            $namaFile = $request->id.".".$request->file("photo")->getClientOriginalExtension();
            $path = $request->file("photo")->storeAs("items", $namaFile, "public");
        }
        if($menu){
            if($menu->update($data)){
                return redirect("admin/menu")->with('pesan',['tipe'=>1, 'isi'=> 'Berhasil update']);
            }
            else{
                return redirect("admin/menu")->with('pesan',['tipe'=>0, 'isi'=> 'Gagal update']);
            }
        }else{
            return redirect("admin/menu")->with('pesan',['tipe'=>0, 'isi'=> 'Gagal update data tidak ditemukan']);
        }
    }
    public function delete(Request $request)
    {
        $menu = Menu::find($request->id);
        if($menu){
            if($menu->delete()){
                return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Success delete menu']);
            }
            else{
                return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Failed delete menu']);
            }
        }else{
            return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal delete data tidak ditemukan']);
        }
    }


    public function lprod()
    {
        $menus = Menu::get();
        // dd($menus);
        return DataTables::of($menus)
            ->addColumn('kategori', function ($data) {
                $load = KategoriMenu::where('id', $data->id_kategori)->pluck('name')->first();
                // $hasil = str_replace(array('"','[',']' ), '', $load);
                // return $hasil;
                return "<p>$load</p>";
            })
            ->addColumn('btnDelete', function ($data) {
                return "<a href='" . url("admin/menu/edit/$data->id") . "' class='btn btn-warning' onclick='return confirm(`Are you sure you want to edit $data->name ?`);'>Edit</a><br><br><a href='" . url("admin/menu/delete/$data->id") . "' class='btn btn-danger' onclick='return confirm(`Are you sure you want to delete $data->name ?`);'>Delete</a>";
            })
            ->addColumn('picture', function ($data) {
                return "<img src='" . asset("storage/items/$data->id.jpg") . "' class='card-img-top' alt='...' style='height:150px;width:150px;'>";
            })

            ->rawColumns(['btnDelete', 'kategori', 'picture'])
            ->make(true);
    }

}
