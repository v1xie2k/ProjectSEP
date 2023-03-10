<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("menu")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        $timeDate = Carbon::now();
        DB::table("menu")->insert([
            ["id_kategori"=>2,"name" => "Indomie","harga"=>3000,"deskripsi"=>"indomiegorenk", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>2,"name" => "Sarimie","harga"=>2500,"deskripsi"=>"sarimiegorenk", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>2,"name" => "Ramen","harga"=>25000,"deskripsi"=>"special ramen", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>4,"name" => "Ice Tea","harga"=>4000,"deskripsi"=>"sweet ice tea", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>4,"name" => "Soju","harga"=>75000,"deskripsi"=>"fermented alcoholic beverages", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>5,"name" => "Ice Cream","harga"=>5000,"deskripsi"=>"ya ice cream", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>5,"name" => "Pudding","harga"=>15000,"deskripsi"=>"Strawberry pudding", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>4,"name" => "Oreo Milkshake","harga"=>25000,"deskripsi"=>"cookies n cream milkshake", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>1,"name" => "Callifornia Roll","harga"=>55000,"deskripsi"=>"Callifornia Roll", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>1,"name" => "Sashimi","harga"=>35000,"deskripsi"=>"Tuna Sashimi", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>3,"name" => "Fried Rice","harga"=>25000,"deskripsi"=>"yummy", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>3,"name" => "Porridge","harga"=>20000,"deskripsi"=>"bubur", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>1,"name" => "All Platter","harga"=>275000,"deskripsi"=>"Paket Lengkap", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>2,"name" => "Lor mee","harga"=>25000,"deskripsi"=>"Chinese Hokkien noodle dish ", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>4,"name" => "Ocha","harga"=>5000,"deskripsi"=>"Just green tea ", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>4,"name" => "Sake","harga"=>95000,"deskripsi"=>"Alcoholic beverages ", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>1,"name" => "Sake Salmon","harga"=>75000,"deskripsi"=>"Premium Quality ", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>2,"name" => "Samyang","harga"=>25000,"deskripsi"=>"Very Spicy ", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>1,"name" => "Tamago","harga"=>55000,"deskripsi"=>"Oishii des", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>3,"name" => "Chicken Teriyaki","harga"=>35000,"deskripsi"=>"Oishii des", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>3,"name" => "Beef Yakiniku","harga"=>45000,"deskripsi"=>"Oishii des", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>2,"name" => "Udon","harga"=>45000,"deskripsi"=>"Noodles texture is thicc", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>5,"name" => "Dango","harga"=>5000,"deskripsi"=>"3 colourful balls", "created_at" => $timeDate, "updated_at" => $timeDate],
            ["id_kategori"=>5,"name" => "Dorayaki","harga"=>7500,"deskripsi"=>"Doraemon's Fav Food", "created_at" => $timeDate, "updated_at" => $timeDate],

        ]);
    }
}
