<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_resep;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\PembelianDb;

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

    public function lpembelian()
    {
        $pembelian = PembelianDb::get();
        // dd($pembelian);

        return DataTables::of($pembelian)
            ->addColumn('name', function ($data) {
                $load = barang::where('id', $data->id_barang)->pluck('name')->first();
                // dd($load);
                return "<p>$load</p>";
            })

            ->rawColumns(['name'])
            ->make(true);
    }

    public function pembelian(Request $request)
    {
        $item = barang::get();
        // dd($barang);
        if(isLogin())return view('master.pembelian.pembelian',compact('item'));
        abort(403);
    }

    public function doPembelian(Request $request)
    {
        $data = $request->all();
        $items = $request->input('items', []);
        $quantities = $request->input('qty', []);
        $harga = $request->input('harga', []);
        $supplier = $request->input('supplier', []);

        for ($i=0; $i < count($quantities); $i++) {
            if ($quantities[$i] != '') {
                $dataResepDetail['id_barang'] = $items[$i];
                $dataResepDetail['qty'] = $quantities[$i];
                $barang = barang::find($items[$i]);
                $qtyAkhir = $barang['stok'] + $quantities[$i];
                $barang->stok = $qtyAkhir;
                $barang->save();
            };
        }

        for ($i=0; $i < count($quantities); $i++) {
            if ($quantities[$i] != '') {
                $dataPembelian['id_barang'] = $items[$i];
                $dataPembelian['qty'] = $quantities[$i];
                $dataPembelian['harga'] = $harga[$i];
                $dataPembelian['supplier'] = $supplier[$i];
                PembelianDb::create($dataPembelian);
            };
        }
        return redirect("admin/barang/pembelian")->with('pesan',['tipe'=>1, 'isi'=> 'Berhasil tambah stock']);
    }

    public function docreate(Request $request)
    {

        $data = $request->all();
        $data["stok"] = 0;
        $id = barang::create($data);

        if($id){
            return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Berhasil insert']);
        }
        else{
            return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal insert']);
        }
    }
}
