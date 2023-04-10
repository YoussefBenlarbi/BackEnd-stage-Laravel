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

        Reservation::create([
            'user_id'   => 1,
            'car_id' => 2,
            'date_start' => '2023-04-12',
            'date_end' => '2023-04-19',
            'note' => 'note merigla',
        ]);
    }
}
