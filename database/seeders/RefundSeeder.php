<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("refund")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $time = Carbon::today()->toDateString();
        $timeDate = Carbon::now();
        DB::table("refund")->insert([
            ["id_user" => "5","subtotal"=> 5000,"name_admin"=>"admin1", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "5","subtotal"=> 50000,"name_admin"=>"admin2", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "4","subtotal"=> 5000,"name_admin"=>"admin2", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "4","subtotal"=> 15000,"name_admin"=>"admin3", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_user" => "6","subtotal"=> 35000,"name_admin"=>"admin1", "created_at" => $timeDate, "updated_at" => $timeDate],
        ]);
    }
}
