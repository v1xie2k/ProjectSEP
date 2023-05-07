<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\logRekonsiliasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class rekonsiliasiController extends Controller
{
    public function home(Request $request)
    {
        $item = barang::orderBy('name','asc')->get();
        if(isLogin())return view('master.rekonsiliasi.home',compact('item'));
        abort(403);
    }
    public function docreate(Request $request)
    {
        $status = 0;
        $data = $request->all();
        $items = $request->input('items', []);
        $quantities = $request->input('qty', []);
        $arr = [];
        for ($i=0; $i < count($quantities); $i++) {
            if ($quantities[$i] != '') {
                $arrayItem = explode('-', $items[$i], 2);
                $stat = 0;
                for ($k=0; $k < count($arr) ; $k++) {
                    if($arr[$k]['id']+0 == $arrayItem[0]+0){
                        $arr[$k]['qty'] += $quantities[$i];
                        $stat = 1;
                    }
                }
                if($stat == 0){
                    $newData = array('id'=>$arrayItem[0]+0, 'qty'=>$quantities[$i]+0, 'name'=>$arrayItem[1]);
                    array_push($arr, $newData);
                }
            };
        }
        $ldate = date('Y-m-d');
        for ($i=0; $i < count($arr); $i++) {
            $status = 1;
            $updateRekonsiliasi = DB::table('barang')->where('id',$arr[$i]['id'])->update(['stok'=>$arr[$i]['qty'], 'updated_at'=>$ldate]);
            $id = logRekonsiliasi::create($arr[$i]);
        }
        if($status == 1){
            return redirect()->back()->with(['pesan' => ['tipe' => 1, 'isi' => 'Success Rekonsiliasi Stok']]);
        }else{
            return redirect()->back()->with(['pesan' => ['tipe' => 0, 'isi' => 'Gagal Rekonsiliasi Stok']]);
        }
    }
    public function lprod()
    {
        $rekonsiliasi = logRekonsiliasi::get();
        // dd($rekonsiliasi);

        return DataTables::of($rekonsiliasi)
            ->make(true);
    }
}
