<?php

namespace Database\Factories;

use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{
    protected $model = Seat::class;

    public function definition()
    {
        return [
            // Definisikan atribut-atribut model Seat di sini
            'nama' => $this->faker->name,
            'is_available' => $this->faker->boolean,
        ];
    }
}
