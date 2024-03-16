<?php

namespace Database\Seeders;

use App\Models\Manual;
use Illuminate\Database\Seeder;

class ManualSeeder extends Seeder
{
    public function run(): void
    {
        Manual::factory(50)->create();
    }
}
