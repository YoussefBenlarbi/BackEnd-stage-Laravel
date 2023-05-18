<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Reservation::create([
        //     'user_id'   => 3,
        //     'car_id' => 27,
        //     'date_start' => '2023-05-23',
        //     'date_end' => '2023-05-29',
        //     'note' => 'note merigla',
        // ]);
        // Reservation::create([
        //     'user_id'   => 4,
        //     'car_id' => 28,
        //     'date_start' => '2023-5-01',
        //     'date_end' => '2023-05-19',
        //     'note' => 'note merigla',
        // ]);
        // Reservation::create([
        //     'user_id'   => 5,
        //     'car_id' => 29,
        //     'date_start' => '2023-5-12',
        //     'date_end' => '2023-6-20',
        //     'note' => 'note merigla',
        // ]);
        Reservation::factory(20)->create();
    }
}
