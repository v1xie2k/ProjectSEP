<?php

namespace App\Http\Controllers;

use App\Models\Dtrans;
use App\Models\Htrans;
use App\Models\KategoriMenu;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
        if(Session::get('start_month') == null){
            $start_date = new Carbon('first day of this month');
            Session::put('start_month',$start_date);
        }
        if(Session::get('end_month') == null){
            $end_date = new Carbon('last day of this month');
            Session::put('end_month',$end_date);
        }
        $start = Session::get('start_date');
        $end = Session::get('end_date');
        $start_month = Session::get('start_month');
        $end_month = Session::get('end_month');
        $invoice = Htrans::where('created_at','>=',$start)->where('created_at','<=',$end)->get();
        $menuFav = Dtrans::where('created_at','>=',$start_month)->where('created_at','<=',$end_month)->get();
        $arrMenuFav = [];
        foreach ($menuFav as $val) {
            $id = $val->id_menu;
            $qty = $val->quantity;
            $price = number_format($val->price, 0, ',', '.');
            $name = $val->name_menu;
            $stat = 0;
            for ($i=0; $i < count($arrMenuFav); $i++) {
                if($arrMenuFav[$i]['id']+0 == $id){
                    $arrMenuFav[$i]['qty'] += $qty;
                    $stat = 1;
                }
            }
            if($stat == 0){
                $newData = array('id'=>$id, 'qty'=>$qty, 'name_menu'=>$name , 'price'=>$price);
                array_push($arrMenuFav, $newData);
            }
        }
        $newdArrMenuFav = collect($arrMenuFav)->sortBy('qty')->reverse()->toArray();
        $collection = Collection::make($newdArrMenuFav);

        $menuFav = $collection->take(3)->toArray();

        $menuFav = array_slice($newdArrMenuFav, 0, 3);

        $total_trans = 0;
        $total_income = 0;
        $total_qty = 0;
        foreach ($invoice as $value) {
            $total_income += $value->total;
            $total_qty += $value->quantity;
            $total_trans++;
            $jum = number_format($value->total, 0, ',', '.');
            $value['total'] = $jum ;
        }
        return view('master.Reports.home',compact('start','end','total_trans','total_income','total_qty','invoice','menuFav'));
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
    public function filtermonth(Request $request)
    {
        $filter = $request->filtermonth;
        if($filter == '0'){
            $start_date = new Carbon('first day of this month');
            $end_date = new Carbon('last day of this month');
        }else{
            $start_date = new Carbon('first day of last month');
            $end_date = new Carbon('last day of last month');
        }
        Session::forget('start_month');
        Session::forget('end_month');
        Session::put('start_month',$start_date);
        Session::put('end_month',$end_date);
        return redirect()->back();
    }

    public function data(Request $request)
    {
        $year = date("Y");
        $order["Jan"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",1)->whereYear("created_at",$year)->sum('total');
        $order["Feb"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",2)->whereYear("created_at",$year)->sum('total');
        $order["Mar"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",3)->whereYear("created_at",$year)->sum('total');
        $order["Apr"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",4)->whereYear("created_at",$year)->sum('total');
        $order["Mei"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",5)->whereYear("created_at",$year)->sum('total');
        $order["Jun"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",6)->whereYear("created_at",$year)->sum('total');
        $order["Jul"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",7)->whereYear("created_at",$year)->sum('total');
        $order["Aug"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",8)->whereYear("created_at",$year)->sum('total');
        $order["Sep"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",9)->whereYear("created_at",$year)->sum('total');
        $order["Okt"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",10)->whereYear("created_at",$year)->sum('total');
        $order["Nov"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",11)->whereYear("created_at",$year)->sum('total');
        $order["Des"] = Htrans::where("id_ekspedisi",">",1)->whereMonth("created_at",12)->whereYear("created_at",$year)->sum('total');

        $year = date("Y");
        $order["Jan1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",1)->whereYear("created_at",$year)->sum('total');
        $order["Feb1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",2)->whereYear("created_at",$year)->sum('total');
        $order["Mar1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",3)->whereYear("created_at",$year)->sum('total');
        $order["Apr1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",4)->whereYear("created_at",$year)->sum('total');
        $order["Mei1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",5)->whereYear("created_at",$year)->sum('total');
        $order["Jun1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",6)->whereYear("created_at",$year)->sum('total');
        $order["Jul1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",7)->whereYear("created_at",$year)->sum('total');
        $order["Aug1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",8)->whereYear("created_at",$year)->sum('total');
        $order["Sep1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",9)->whereYear("created_at",$year)->sum('total');
        $order["Okt1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",10)->whereYear("created_at",$year)->sum('total');
        $order["Nov1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",11)->whereYear("created_at",$year)->sum('total');
        $order["Des1"] = Htrans::where("id_ekspedisi",1)->whereMonth("created_at",12)->whereYear("created_at",$year)->sum('total');

        return $order;
    }

}
