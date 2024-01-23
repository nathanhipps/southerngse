<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        foreach (User::all() as $user) {
            Cart::create(['user_id' => $user->id]);
        }
    }
}
