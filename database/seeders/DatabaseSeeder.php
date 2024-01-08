<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\Card;
use App\Models\Cart;
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

        User::factory(10)->create();

        foreach (User::all() as $user) {
            Cart::create(['user_id' => $user->id]);

            Card::factory(3)->create(['user_id' => $user->id]);
            Address::factory(3)->create(['user_id' => $user->id]);
        }

        $this->call([
            ManufacturerSeeder::class,
            PartSeeder::class,
        ]);
    }
}
