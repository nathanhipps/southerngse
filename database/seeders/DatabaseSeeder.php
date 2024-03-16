<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Nathan Hipps',
            'email' => 'nathan@clickable.dev',
            'is_admin' => 1
        ]);

        $user = User::factory()->create([
            'name' => 'Jason Lemley',
            'email' => 'jason@southerngse.com',
            'is_admin' => 1
        ]);

        User::factory(10)->create();

        $this->call([
            CartSeeder::class,
            ManufacturerSeeder::class,
            PartSeeder::class,
            CardSeeder::class,
            AddressSeeder::class,
            FreightCarrierSeeder::class,
            OrderSeeder::class,
            LeadSeeder::class,
            UsedEquipmentSeeder::class,
            ManualSeeder::class,
        ]);
    }
}
