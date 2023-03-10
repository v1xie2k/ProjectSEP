<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("users")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");
        DB::table("users")->insert([
            [
            "name" => "admin1" ,
            "email" => "admin1@gmail.com",
            'password' => Hash::make('123'),
            "alamat" => "jl admin1",
            "saldo" => 0,
            "role" => "admin",
            "created_at" => date("Y-m-d H-i-s"),
            "updated_at" => date("Y-m-d H-i-s"),
            ],
            [
            "name" => "admin2" ,
            "email" => "admin2@gmail.com",
            'password' => Hash::make('123'),
            "alamat" => "jl admin2",
            "saldo" => 0,
            "role" => "admin",
            "created_at" => date("Y-m-d H-i-s"),
            "updated_at" => date("Y-m-d H-i-s"),
            ],
            [
            "name" => "admin3" ,
            "email" => "admin3@gmail.com",
            'password' => Hash::make('123'),
            "alamat" => "jl admin3",
            "saldo" => 0,
            "role" => "admin",
            "created_at" => date("Y-m-d H-i-s"),
            "updated_at" => date("Y-m-d H-i-s"),
            ],
            [
                "name" => "pekora" ,
                "email" => "pekora@gmail.com",
                'password' => Hash::make('123'),
                "alamat" => "jl pekora",
                "saldo" => 150000,
                "role" => "user",
                "created_at" => date("Y-m-d H-i-s"),
                "updated_at" => date("Y-m-d H-i-s"),
            ],
            [
                "name" => "botan" ,
                "email" => "botan@gmail.com",
                'password' => Hash::make('123'),
                "alamat" => "jl botan",
                "saldo" => 25000,
                "role" => "user",
                "created_at" => date("Y-m-d H-i-s"),
                "updated_at" => date("Y-m-d H-i-s"),
            ],
            [
                "name" => "aqua" ,
                "email" => "aqua@gmail.com",
                'password' => Hash::make('123'),
                "alamat" => "jl aqua",
                "saldo" => 55000,
                "role" => "user",
                "created_at" => date("Y-m-d H-i-s"),
                "updated_at" => date("Y-m-d H-i-s"),
            ],
        ]);
        Users::factory()->count(5)->create();
    }
}
