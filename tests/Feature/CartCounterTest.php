<?php

use App\Livewire\Cart\Counter;
use App\Models\Cart;
use App\Models\Part;
use Livewire\Livewire;

beforeEach(fn() => $this->setupAccount());

it('hides the cart link when cart is empty', function () {
    Livewire::actingAs($this->user)
        ->test(Counter::class)
        ->assertDontSee(route('cart'));
});

it('shows the cart link when cart has an item', function () {
    $this->actingAs($this->user);
    Cart::addItem(Part::factory()->create());

    Livewire::test(Counter::class)
        ->assertSee(route('cart'));
});

it('shows the login link when cart has an item and the user is not logged in', function () {
    Cart::addItem(Part::factory()->create());

    Livewire::test(Counter::class)
        ->assertSee(route('login'));
});

it('can toggle the cart button on', function () {
    Livewire::actingAs($this->user)
        ->test(Counter::class)
        ->assertSet('show', false)
        ->dispatch('item-added-to-cart')
        ->assertSet('show', true);
});
