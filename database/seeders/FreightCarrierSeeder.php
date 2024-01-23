<?php

namespace Database\Seeders;

use App\Models\FreightCarrier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class FreightCarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            foreach (range(1, Arr::random([2, 3, 4, 5])) as $round) {
                FreightCarrier::factory()->create(['user_id' => $user->id]);
            }
        });
    }
}
