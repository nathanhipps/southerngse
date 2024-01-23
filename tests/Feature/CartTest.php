<?php

use App\Livewire\Cart\Show;
use App\Models\Cart;
use App\Models\Part;
use Livewire\Livewire;

beforeEach(fn () => $this->setupAccount());

it('has cart page', function () {
    $this->actingAs($this->user);

    Cart::addItem($part1 = Part::factory()->create());
    Cart::addItem($part2 = Part::factory()->create());

    Livewire::test(Show::class)
        ->assertSee($part1->sku)
        ->assertSee($part2->sku);
});
