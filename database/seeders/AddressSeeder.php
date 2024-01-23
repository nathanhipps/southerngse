<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            foreach (range(1, Arr::random([2, 3, 4, 5])) as $round) {
                Address::factory()->create(['user_id' => $user->id]);
            }
        });
    }
}
