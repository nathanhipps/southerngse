<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CardFactory extends Factory
{
    public function definition(): array
    {
        return [
            'stripe_id' => $this->faker->md5,
            'last_four' => $this->faker->numberBetween(1000, 9999),
            'brand' => Arr::random(['Visa', 'Master Card', 'Discover', 'American Express']),
            'exp_month' => $this->faker->randomNumber(1, 12),
            'exp_year' => now()->addYears(Arr::random([1, 2, 3, 4]))->year,
            'user_id' => User::factory(),
        ];
    }
}
