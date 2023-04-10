<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create(
            [
                'name' => Str::random(6),
                'plat' => Str::random(10),
                'description' => Str::random(20),
                'status' => 0,
                'price' => rand(600, 2000),
            ]
        );
    }
}
