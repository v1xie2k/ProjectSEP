<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("ekspedisi")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $timeDate = Carbon::now();
        DB::table("ekspedisi")->insert([
            ["name" => "Grab Send","ongkir"=> 15000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["name" => "Go Send","ongkir"=> 14000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["name" => "Courier","ongkir"=> 13000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["name" => "Ojek","ongkir"=> 10000, "created_at" => $timeDate, "updated_at" => $timeDate],

        ]);
    }
}
