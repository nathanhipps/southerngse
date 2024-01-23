<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class FreightCarrierFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => Arr::random([
                'UPS',
                'FedEx',
                'USPS',
                'Yellow',
                'USF Dugan',
            ]),
            'account_number' => $this->faker->md5,
        ];
    }
}
