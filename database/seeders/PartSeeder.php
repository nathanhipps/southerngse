<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Part;
use Illuminate\Database\Seeder;

class PartSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['Switches', 'toggle-right'],
            ['Boards', 'circuitry'],
            ['Gauges', 'gauge'],
            ['Power Cables', 'plug'],
            ['AC Hoses', 'wind'],
            ['Transformers', 'spiral'],
            ['Sheet Metal Panels', 'square-logo'],
        ])->each(function ($item) {
            Category::factory()->create([
                'name' => $item[0],
                'icon' => $item[1],
            ]);
        });

        $manufacturers = Manufacturer::factory(10)->create();

        Part::factory(500)->recycle($manufacturers)->create();

        $categories = Category::all();

        Part::all()->each(function ($part) use ($categories) {
            $part->categories()->attach($categories->random());
        });
    }
}
