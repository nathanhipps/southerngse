<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Card;
use App\Models\FreightCarrier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'card_id' => Card::factory(),
            'address_id' => Address::factory(),
            'carrier_id' => FreightCarrier::factory(),
            'shipping_time' => Arr::random(['Ground', 'ASAP']),
            'shipping' => $shipping = $this->faker->numberBetween(0, 10000),
            'tax' => $tax = $this->faker->numberBetween(0, 10000),
            'subtotal' => $subtotal = $this->faker->numberBetween(0, 999999),
            'total' => $shipping + $tax + $subtotal,
            'tracking_number' => $this->faker->md5(),
            'closed_at' => Arr::random([null, now()->subDays($this->faker->numberBetween(1, 720))])
        ];
    }
}
