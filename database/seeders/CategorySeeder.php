<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("kategori_menu")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $timeDate = Carbon::now();
        DB::table("kategori_menu")->insert([
            ["name" => "Sushi", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["name" => "Noodles", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["name" => "Rice", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["name" => "Beverages", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["name" => "Dessert", "created_at" => $timeDate, "updated_at" => $timeDate],

        ]);
    }
}
