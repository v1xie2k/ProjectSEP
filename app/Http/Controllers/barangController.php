<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class barangController extends Controller
{
    public function home(Request $request)
    {
        $barang = barang::orderBy('name','asc')->get();
        // dd($barang);
        if(isLogin())return view('master.barang.home',compact('barang'));
        abort(403);
    }

    public function lbarang()
    {
        $barangs = barang::get();

        return DataTables::of($barangs)
        ->addColumn('btnDelete', function ($data) {
            return "<a href='" . url("admin/barang/edit/$data->id") . "' class='btn btn-warning' onclick='return confirm(`Are you sure you want to edit $data->name ?`);'>Edit</a><a href='" . url("admin/barang/delete/$data->id") . "' class='btn btn-danger' onclick='return confirm(`Are you sure you want to delete $data->name ?`);'>Delete</a>";
        })
        ->rawColumns(['btnDelete'])
        ->make(true);
    }

    // public function delete(Request $request)
    // {
    //     $menu = barang::find($request->id);
    //     if($menu){
    //         if($menu->delete()){
    //             return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Success delete menu']);
    //         }
    //         else{
    //             return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Failed delete menu']);
    //         }
    //     }else{
    //         return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal delete data tidak ditemukan']);
    //     }
    // }
}
