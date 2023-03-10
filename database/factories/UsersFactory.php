<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $firstname = $this->faker->firstName();
        $lastname = $this->faker->lastName();
        return [
            'name' => "$firstname $lastname",
            'email' => Str::lower("$firstname@gmail.com"),
            'password' => Hash::make('123'),
            'alamat' => $this->faker->address(),
            'saldo' =>  0,
            'role' => "user",
        ];
    }
}
