<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DtransSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("dtrans")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $timeDate = Carbon::now();
        DB::table("dtrans")->insert([
            ["id_htrans" => 1,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>1, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 1,"id_menu"=> 4,"name_menu"=>"Ice Tea", "price"=>4000, "quantity"=>1, "subtotal"=>4000,"created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 2,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>1, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 2,"id_menu"=> 4,"name_menu"=>"Ice Tea", "price"=>4000, "quantity"=>1, "subtotal"=>4000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 3,"id_menu"=> 24,"name_menu"=>"Dorayaki", "price"=>7500, "quantity"=>1, "subtotal"=>7500, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 3,"id_menu"=> 6,"name_menu"=>"Ice Cream", "price"=>5000, "quantity"=>1, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 4,"id_menu"=> 1,"name_menu"=>"Indomie", "price"=>3000, "quantity"=>3, "subtotal"=>9000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 4,"id_menu"=> 2,"name_menu"=>"Sarimie", "price"=>2500, "quantity"=>2, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 4,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>2, "subtotal"=>10000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 5,"id_menu"=> 1,"name_menu"=>"Indomie", "price"=>3000, "quantity"=>3, "subtotal"=>9000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 5,"id_menu"=> 2,"name_menu"=>"Sarimie", "price"=>2500, "quantity"=>2, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 5,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>2, "subtotal"=>10000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 6,"id_menu"=> 24,"name_menu"=>"Dorayaki", "price"=>7500, "quantity"=>1, "subtotal"=>7500, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 6,"id_menu"=> 6,"name_menu"=>"Ice Cream", "price"=>5000, "quantity"=>1, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 7,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>1, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 7,"id_menu"=> 4,"name_menu"=>"Ice Tea", "price"=>4000, "quantity"=>1, "subtotal"=>4000,"created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 8,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>1, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 8,"id_menu"=> 4,"name_menu"=>"Ice Tea", "price"=>4000, "quantity"=>1, "subtotal"=>4000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 9,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>1, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 9,"id_menu"=> 4,"name_menu"=>"Ice Tea", "price"=>4000, "quantity"=>1, "subtotal"=>4000,"created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 10,"id_menu"=> 1,"name_menu"=>"Indomie", "price"=>3000, "quantity"=>3, "subtotal"=>9000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 10,"id_menu"=> 2,"name_menu"=>"Sarimie", "price"=>2500, "quantity"=>2, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 10,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>2, "subtotal"=>10000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 11,"id_menu"=> 23,"name_menu"=>"Dango", "price"=>5000, "quantity"=>1, "subtotal"=>5000, "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_htrans" => 11,"id_menu"=> 4,"name_menu"=>"Ice Tea", "price"=>4000, "quantity"=>1, "subtotal"=>4000,"created_at" => $timeDate, "updated_at" => $timeDate],
        ]);
    }
}
