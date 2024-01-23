<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Part;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            foreach(range(1, 20) as $round) {
                $items = collect([]);

                foreach(range(1, Arr::random([2, 3, 4, 5, 6])) as $roundTwo) {
                    $part = Part::inRandomOrder()->first();

                    $items->push(
                        OrderItem::make([
                            'sku' => $part->sku,
                            'description' => $part->description,
                            'quantity' => Arr::random([1, 2, 3, 4, 5]),
                            'price' => $part->price,
                            'part_id' => $part->id,
                        ])
                    );
                }

                $order = Order::factory()->create([
                    'user_id' => $user->id,
                    'number' => Order::where('user_id', $user->id)->count() + 10000,
                    'card_id' => $user->cards()->inRandomOrder()->first()->id,
                    'address_id' => $user->addresses()->inRandomOrder()->first()->id,
                    'carrier_id' => $user->carriers()->inRandomOrder()->first()->id,
                    'subtotal' => $subtotal = $items->reduce(function ($carry, $item) {
                        return ($item->price * $item->quantity) + $carry;
                    }, 0),
                    'tax' => $tax = $subtotal * .06,
                    'shipping' => 2_500,
                    'total' => $subtotal + $tax + 2_500
                ]);

                $items->each(fn ($item) => $order->items()->save($item));
            }
        });
    }
}
