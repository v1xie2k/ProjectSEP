<?php

namespace App\Http\Controllers;

use App\Models\HistoryTopUP;
use App\Models\Refund;
use App\Models\Users;
use Illuminate\Http\Request;

class MasterTopupController extends Controller
{
    public function home(Request $request)
    {
        $topup = HistoryTopUP::where('status',0)->get();
        return view('master.topup.home',compact('topup'));
    }

    public function acc(Request $request)
    {
        $acc = HistoryTopUP::find($request->id);
        $userid = $acc->id_user;

        $saldos = Users::find($userid);
        $int = (int)$saldos->saldo;
        $int2 = (int)$acc->topup;
        $update_saldo = $int + $int2 ;
        // dd($update_saldo);
        if($acc){
            if($acc->update(['status'=>1]) && $saldos->update(['saldo'=>$update_saldo])){
                return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Berhasil accept']);
            }
            else{
                return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal accept']);
            }
        }
    }


    public function reject(Request $request)
    {
        $acc = HistoryTopUP::find($request->id);
        $userid = $acc->id_user;

        // $saldos = Users::find($userid);
        // $int = (int)$saldos->saldo;
        // $int2 = (int)$acc->topup;
        // $update_saldo = $int + $int2 ;
        // dd($update_saldo);
        if($acc){
            if($acc->update(['status'=>2])){
                $data = [
                    "id_user" => $acc->id_user,
                    "subtotal" => $acc->topup,
                    "name_admin" => getYangLogin()->name
                ];
                $refund = Refund::create($data);
                if($refund){
                    return redirect()->back()->with('pesan',['tipe'=>1, 'isi'=> 'Berhasil reject']);
                }
                return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal reject']);
            }
            else{
                return redirect()->back()->with('pesan',['tipe'=>0, 'isi'=> 'Gagal reject']);
            }
        }
    }

    public function history(Request $request)
    {
        $topup = HistoryTopUP::where('status','<>',0)->get();
        return view('master.topup.history',compact('topup'));
    }


}
