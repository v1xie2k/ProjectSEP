<?php

namespace App\Http\Controllers;

use App\Exports\TransactionExport;
use App\Exports\TransactionSheetExport;
use App\Models\Dtrans;
use App\Models\Ekspedisi;
use App\Models\Htrans;
use App\Models\Users;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class transactionController extends Controller
{
    public function home(Request $request)
    {
        return view('master.transaction.history');
    }

    public function ltrans()
    {
        $menus = Htrans::get();
        return DataTables::of($menus)
            ->addColumn('btnDetail', function ($data) {
                return "<a href='" . url("admin/transaction/details/$data->id") . "' class='btn btn-success'>Detail</a>";
            })
            ->addColumn('email', function ($data) {
                $email = Users::where('id',$data->id_user)->pluck('email');
                $hasil = str_replace(array('"','[',']' ), '', $email);
                return "$hasil";
            })
            ->addColumn('ekspedisi', function ($data) {
                $ekspedisi = Ekspedisi::where('id',$data->id_ekspedisi)->pluck('name');
                $hasil = str_replace(array('"','[',']' ), '', $ekspedisi);
                return "$hasil";
            })

            ->rawColumns(['btnDetail'])
            ->make(true);
    }

    public function detail(Request $request)
    {
        $dtrans = Dtrans::where('id_htrans',$request->id)->get();
        return view('master.transaction.detail',compact('dtrans'));
    }
    public function doExportExcel(Request $request)
    {
        $user = getYangLogin();
        return Excel::download(new TransactionSheetExport(),'Penjualan.xls');

    }
}
