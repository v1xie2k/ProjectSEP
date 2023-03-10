<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class TopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("history_topup")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $time = Carbon::today()->toDateString();
        $timeDate = Carbon::now();
        DB::table("history_topup")->insert([
            ["id_user" => "5","topup"=> 15000,"status"=>0,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "5","topup"=> 25000,"status"=>1,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "5","topup"=> 5000,"status"=>2,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "5","topup"=> 50000,"status"=>2,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "4","topup"=> 25000,"status"=>0,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "4","topup"=> 150000,"status"=>1,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "4","topup"=> 5000,"status"=>2,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "4","topup"=> 15000,"status"=>2,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "6","topup"=> 35000,"status"=>0,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "6","topup"=> 55000,"status"=>1,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "6","topup"=> 35000,"status"=>2,"date_time"=> $time, "created_at" => $timeDate, "updated_at" => $timeDate],

        ]);
    }
}
