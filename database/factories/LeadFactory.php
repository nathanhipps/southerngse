<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'subject' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'data' => [
                'page' => '/path/to/page'
            ],
        ];
    }
}
