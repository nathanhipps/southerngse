<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ManualFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}
