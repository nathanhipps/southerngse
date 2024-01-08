<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'street' => $this->faker->numberBetween(1, 9999).' '.$this->faker->streetName,
            'details' => $this->faker->secondaryAddress(),
            'city' => $this->faker->city,
            'state' => $this->faker->state(),
            'zip' => $this->faker->postcode,
            'user_id' => User::factory(),
        ];
    }
}
