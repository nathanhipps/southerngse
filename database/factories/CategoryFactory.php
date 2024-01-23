<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => Arr::random([
                'Switches',
                'Boards',
                'Gauges',
                'Power Cables',
                'AC Hoses',
                'Transformers',
                'Sheet Metal Panels',
            ]),
            'icon' => 'infinity'
        ];
    }
}
