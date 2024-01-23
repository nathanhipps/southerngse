<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class CardSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            foreach (range(1, Arr::random([2, 3, 4, 5])) as $round) {
                Card::factory()->create(['user_id' => $user->id]);
            }
        });
    }
}
