<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HtransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("htrans")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $time = Carbon::today()->toDateString();
        $timeDate = Carbon::now();
        $november = new Carbon('first day of November 2022');
        $novtime = $november->toDateString();
        $october = new Carbon('first day of October 2022');
        $octtime = $october->toDateString();
        $september = new Carbon('first day of September 2022');
        $septime = $september->toDateString();
        $august = new Carbon('first day of August 2022');
        $augtime = $august->toDateString();
        DB::table("htrans")->insert([
            ["id_user" => "4","id_ekspedisi"=> 1,"quantity"=>2,"total"=>19000,"date"=>$time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "5","id_ekspedisi"=> 2,"quantity"=>2,"total"=>18000,"date"=>$time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "5","id_ekspedisi"=> 4,"quantity"=>2,"total"=>22500,"date"=>$time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "6","id_ekspedisi"=> 1,"quantity"=>7,"total"=>39000,"date"=>$time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "6","id_ekspedisi"=> 1,"quantity"=>7,"total"=>39000,"date"=>$novtime, "created_at" => $november, "updated_at" => $november],
            ["id_user" => "5","id_ekspedisi"=> 4,"quantity"=>2,"total"=>22500,"date"=>$novtime, "created_at" => $november, "updated_at" => $november],
            ["id_user" => "4","id_ekspedisi"=> 1,"quantity"=>2,"total"=>19000,"date"=>$octtime, "created_at" => $october, "updated_at" => $october],
            ["id_user" => "5","id_ekspedisi"=> 2,"quantity"=>2,"total"=>18000,"date"=>$octtime, "created_at" => $october, "updated_at" => $october],
            ["id_user" => "4","id_ekspedisi"=> 1,"quantity"=>2,"total"=>19000,"date"=>$septime, "created_at" => $september, "updated_at" => $september],
            ["id_user" => "6","id_ekspedisi"=> 1,"quantity"=>7,"total"=>39000,"date"=>$septime, "created_at" => $september, "updated_at" => $september],
            ["id_user" => "4","id_ekspedisi"=> 1,"quantity"=>2,"total"=>19000,"date"=>$augtime, "created_at" => $august, "updated_at" => $august],
        ]);
    }
}
