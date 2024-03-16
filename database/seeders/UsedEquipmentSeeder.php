<?php

namespace Database\Seeders;

use App\Models\UsedEquipment;
use Illuminate\Database\Seeder;

class UsedEquipmentSeeder extends Seeder
{
    public function run(): void
    {
        UsedEquipment::factory(25)->create();
    }
}
