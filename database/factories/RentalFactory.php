<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    public function definition(): array
    {
        return [
            'model_number' => Str::substr($this->faker->md5, 0, 5),
            'description' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 10)
        ];
    }
}
