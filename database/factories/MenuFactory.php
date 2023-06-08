<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Menu;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition()
    {
        return [
            // Definisikan atribut-atribut model Menu di sini
            'nama' => $this->faker->word,
            'jenis' => $this->faker->randomElement(['makanan', 'minuman']),
        ];
    }
}