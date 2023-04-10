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
                'name' => 'Audi S3 Car',
                'mileage' => 10000,
                'thumbnailUrl' => "https://cdn.jdpower.com/Models/640x480/2017-Audi-S3-PremiumPlus.jpg",
                'dailyPrice' => 70,
                'monthlyPrice' => 1600,
                'gearType' => 'Auto',
                'gasType' => 'Petrol',
            ]
        );
        Car::create([
            'name' => 'HONDA City 5 Seater Car',
            'mileage' => 20000,
            'thumbnailUrl' => "https://shinewiki.com/wp-content/uploads/2019/11/honda-city.jpg",
            'dailyPrice' => 50,
            'monthlyPrice' => 1500,
            'gearType' => 'Auto',
            'gasType' => 'Petrol',
        ]);
        Car::create(
            [
                'name' => 'Mercedes 205',
                'mileage' => 10000,
                'thumbnailUrl' => "https://cdn.jdpower.com/Models/640x480/2017-Audi-S3-PremiumPlus.jpg",
                'dailyPrice' => 45,
                'monthlyPrice' => 1200,
                'gearType' => 'Auto',
                'gasType' => 'Petrol',
            ]
        );
        Car::create([
            'name' => 'Ferrari spider',
            'mileage' => 5000,
            'thumbnailUrl' => "https://shinewiki.com/wp-content/uploads/2019/11/honda-city.jpg",
            'dailyPrice' => 80,
            'monthlyPrice' => 3500,
            'gearType' => 'Manual',
            'gasType' => 'Petrol',
        ]);
        Car::create(
            [
                'name' => 'Honda Civic 2007',
                'mileage' => 25000,
                'thumbnailUrl' => "https://cdn.jdpower.com/Models/640x480/2017-Audi-S3-PremiumPlus.jpg",
                'dailyPrice' => 55,
                'monthlyPrice' => 1750,
                'gearType' => 'Auto',
                'gasType' => 'Petrol',
            ]
        );
        Car::create([
            'name' => 'Clio 4 ',
            'mileage' => 19000,
            'thumbnailUrl' => "https://shinewiki.com/wp-content/uploads/2019/11/honda-city.jpg",
            'dailyPrice' => 380,
            'monthlyPrice' => 1700,
            'gearType' => 'Manual',
            'gasType' => 'Petrol',
        ]);

    }
}
