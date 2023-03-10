<?php

namespace App\Http\Controllers;

use App\Models\Htrans;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MasterReportController extends Controller
{
    public function home(Request $request)
    {
        // $end_date = $request->end_date ?  Carbon::parse($request->end_date) : new Carbon('last day of this month');
        //Carbon::parse('11/21/2022') m/d/y
        if(Session::get('start_date') == null)
        {
            $start_date = new Carbon('first day of this month');
            Session::put('start_date',$start_date);
        }
        if(Session::get('end_date') == null)
        {
            $end_date = new Carbon('last day of this month');
            Session::put('end_date',$end_date);
        }
        $start = Session::get('start_date');
        $end = Session::get('end_date');
        $invoice = Htrans::where('created_at','>=',$start)->where('created_at','<=',$end)->get();
        $total_trans = 0;
        $total_income = 0;
        $total_qty = 0;
        foreach ($invoice as $value) {
            $total_income += $value->total;
            $total_qty += $value->quantity;
            $total_trans++;
        }


        // $year = date("Y");
        // $order["Jan"] = Htrans::whereMonth("created_at",1)->whereYear("created_at",$year)->sum('total');
        // $order["Feb"] = Htrans::whereMonth("created_at",2)->whereYear("created_at",$year)->sum('total');
        // $order["Mar"] = Htrans::whereMonth("created_at",3)->whereYear("created_at",$year)->sum('total');
        // $order["Apr"] = Htrans::whereMonth("created_at",4)->whereYear("created_at",$year)->sum('total');
        // $order["Mei"] = Htrans::whereMonth("created_at",5)->whereYear("created_at",$year)->sum('total');
        // $order["Jun"] = Htrans::whereMonth("created_at",6)->whereYear("created_at",$year)->sum('total');
        // $order["Jul"] = Htrans::whereMonth("created_at",7)->whereYear("created_at",$year)->sum('total');
        // $order["Aug"] = Htrans::whereMonth("created_at",8)->whereYear("created_at",$year)->sum('total');
        // $order["Sep"] = Htrans::whereMonth("created_at",9)->whereYear("created_at",$year)->sum('total');
        // $order["Okt"] = Htrans::whereMonth("created_at",10)->whereYear("created_at",$year)->sum('total');
        // $order["Nov"] = Htrans::whereMonth("created_at",11)->whereYear("created_at",$year)->sum('total');
        // $order["Des"] = Htrans::whereMonth("created_at",12)->whereYear("created_at",$year)->sum('total');
        // dd($order);

        return view('master.Reports.home',compact('start','end','total_trans','total_income','total_qty','invoice'));
    }
    public function filterDate(Request $request)
    {
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        Session::forget('start_date');
        Session::forget('end_date');
        Session::put('start_date',$start);
        Session::put('end_date',$end);
        return redirect()->back();
    }

    public function data(Request $request)
    {
        $year = date("Y");
        $order["Jan"] = Htrans::whereMonth("created_at",1)->whereYear("created_at",$year)->sum('total');
        $order["Feb"] = Htrans::whereMonth("created_at",2)->whereYear("created_at",$year)->sum('total');
        $order["Mar"] = Htrans::whereMonth("created_at",3)->whereYear("created_at",$year)->sum('total');
        $order["Apr"] = Htrans::whereMonth("created_at",4)->whereYear("created_at",$year)->sum('total');
        $order["Mei"] = Htrans::whereMonth("created_at",5)->whereYear("created_at",$year)->sum('total');
        $order["Jun"] = Htrans::whereMonth("created_at",6)->whereYear("created_at",$year)->sum('total');
        $order["Jul"] = Htrans::whereMonth("created_at",7)->whereYear("created_at",$year)->sum('total');
        $order["Aug"] = Htrans::whereMonth("created_at",8)->whereYear("created_at",$year)->sum('total');
        $order["Sep"] = Htrans::whereMonth("created_at",9)->whereYear("created_at",$year)->sum('total');
        $order["Okt"] = Htrans::whereMonth("created_at",10)->whereYear("created_at",$year)->sum('total');
        $order["Nov"] = Htrans::whereMonth("created_at",11)->whereYear("created_at",$year)->sum('total');
        $order["Des"] = Htrans::whereMonth("created_at",12)->whereYear("created_at",$year)->sum('total');

        return $order;
    }

}
