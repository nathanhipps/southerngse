<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Part;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;

beforeEach(fn() => $this->setupAccount());

it('adds a part to the session when not logged in', function () {
    $part = Part::factory()->create();

    $this->get('/');

    expect(Cart::hasItems())->toBeFalse
        ->and(CartItem::count())->toBe(0)
        ->and(session()->get('cart'))->toBeNull;

    Cart::addItem($part);

    expect(Cart::hasItems())->toBeTrue
        ->and(CartItem::count())->toBe(0)
        ->and(session()->get('cart'))->toBe([
            $part->id => 1
        ]);
});

it('adds an item to the db when logged in', function () {
    $this->actingAs($this->user);

    expect(CartItem::count())->toBe(0);

    $part = Part::factory()->create();
    Cart::addItem($part);

    expect(CartItem::count())->toBe(1)
        ->and(auth()->user()->cart->items()->count())->toBe(1)
        ->and(auth()->user()->cart->items()->first())
            ->part_id->toBe($part->id)
            ->quantity->toBe(1)
            ->cart_id->toBe(auth()->user()->cart->id);
});

it('can calculate a subtotal', function () {
    $this->actingAs($this->user);

    $part1 = Part::factory()->create(['price' => 5000]);
    $part2 = Part::factory()->create(['price' => 10000]);

    Cart::addItem($part1);
    Cart::addItem($part1);
    Cart::addItem($part2);

    expect(auth()->user()->cart->subtotal())
        ->toEqual(20000);
});

it('can merge storage types', function () {
    $part1 = Part::factory()->create(['price' => 5000]);
    $part2 = Part::factory()->create(['price' => 10000]);

    CartItem::create([
        'cart_id' => $this->user->cart->id,
        'part_id' => $part1->id,
        'quantity' => 1,
    ]);

    $this->get('/');

    Cart::addItem($part2);

    $this->actingAs($this->user);

    Event::dispatch(Login::class);

    expect(auth()->user()->cart->subtotal())
        ->toEqual(15000);
});

it('can calculate a shipping estimate for under threshold', function () {
    $this->actingAs($this->user);

    $part1 = Part::factory()->create(['price' => 5000]);
    $part2 = Part::factory()->create(['price' => 10000]);

    Cart::addItem($part1);
    Cart::addItem($part2);

    expect(auth()->user()->cart->shippingEstimate())
        ->toEqual(2500);
});

it('can calculate a shipping estimate for over threshold', function () {
    $this->actingAs($this->user);

    $part1 = Part::factory()->create(['price' => 60000]);

    Cart::addItem($part1);

    expect(auth()->user()->cart->shippingEstimate())
        ->toEqual(60000 * .05);
});

it('can calculate a shipping estimate when cart is empty', function () {
    $this->actingAs($this->user);

    expect(auth()->user()->cart->shippingEstimate())
        ->toEqual(0);
});

it('can calculate tax for a cart', function () {
    $this->actingAs($this->user);

    expect(auth()->user()->cart->taxEstimate())
        ->toEqual(0);
});

it('can calculate a total', function () {
    $this->actingAs($this->user);

    $part1 = Part::factory()->create(['price' => 5000]);
    $part2 = Part::factory()->create(['price' => 10000]);

    Cart::addItem($part1);
    Cart::addItem($part2);

    expect(auth()->user()->cart->total())
        ->toEqual(
            auth()->user()->cart->subtotal() +
            auth()->user()->cart->shippingEstimate()
        );
});
