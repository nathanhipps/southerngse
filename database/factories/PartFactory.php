<?php

namespace Database\Factories;

use App\Models\Manufacturer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'sku' => $this->faker->numberBetween(10000, 99999),
            'description' => $this->faker->sentence,
            'price' => $price = $this->faker->numberBetween(100, 99999),
            'cost' => $price * .65,
            'inventory' => $this->faker->numberBetween(0, 100),
            'lead_time_in_days' => $this->faker->numberBetween(0, 365),
            'slug' => $this->faker->slug,
            'image_path' => 'https://source.unsplash.com/random',
            'manufacturer_id' => Manufacturer::factory(),
        ];
    }
}
