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
            ['Switches', 'iconpark-switchbutton-o'],
            ['Boards', 'phosphor-circuitry-light'],
            ['Gauges', 'phosphor-gauge-light'],
            ['Power Cables', 'gmdi-power-o'],
            ['AC Hoses', 'gmdi-air-r'],
            ['Transformers', 'tabler-circuit-resistor'],
            ['Sheet Metal Panels', 'sui-panel-center'],
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
