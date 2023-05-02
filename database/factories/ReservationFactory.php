<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $date_start = fake()->dateTimeBetween('now', '+1 year');
    $date_end = fake()->dateTimeBetween($date_start, $date_start->format('Y-m-d H:i:s') . ' +1 year');
    $date_reservation = fake()->dateTimeBetween('first day of January this year', 'last day of December this year');
    return [
        'date_start' => $date_start->format('Y-m-d'),
        'date_end' => $date_end->format('Y-m-d'),
        'date_reservation' => $date_reservation->format('Y-m-d'),
        'status' => 2,
        // 'total' => fake()->numberBetween(1990, 2004),
        'note' => fake()->country(),
        'car_id' => Car::all()->random()->id,
        'user_id' => User::where('is_admin', '<>', 1)->get()->random()->id
    ];
}
}
