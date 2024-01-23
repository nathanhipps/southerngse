<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'sku' => $this->faker->md5(),
            'description' => $this->faker->sentence(),
            'quantity' => $quantity = $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(100, 999999),
            'part_id' => Part::factory(),
        ];
    }
}
