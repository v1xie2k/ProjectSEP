<?php

namespace App\Http\Controllers;

use App\Models\KategoriMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function home(Request $request)
    {
        $categories = KategoriMenu::get();
        return view('master.Categories.home',compact('categories'));
    }
    public function docreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $data = $request->all();
        if(KategoriMenu::create($data)){
            return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Berhasil insert']);
        }
        else{
            return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal insert']);
        }
    }
    public function detail(Request $request)
    {
        $category = KategoriMenu::find($request->id);
        return view('master.Categories.detail',compact('category'));
    }
    public function doedit(Request $request)
    {
        $category = KategoriMenu::find($request->id);
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $data = $request->all();
        if($category){
            if($category->update($data)){
                return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Berhasil update']);
            }
            else{
                return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal update']);
            }
        }else{
            return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal update data tidak ditemukan']);
        }
    }
    public function delete(Request $request)
    {
        $category = KategoriMenu::find($request->id);
        if($category){
            $menus = Menu::where('id_kategori',$request->id )->get();
            if(sizeof($menus) == 0){
                if($category->delete()){
                    return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Success delete category']);
                }
                else{
                    return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Failed delete category']);
                }
            }else{
                return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Failed delete category it have items init']);
            }
        }else{
            return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal delete data tidak ditemukan']);
        }
    }
}
