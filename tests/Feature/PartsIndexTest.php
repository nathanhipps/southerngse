<?php

use App\Livewire\Parts\Index;
use App\Models\Category;
use App\Models\Part;
use Livewire\Livewire;

beforeEach(fn() => $this->setupAccount());

it('can search for parts', function () {
    $searchedFor = Part::factory()->create([
        'sku' => '123456'
    ]);

    $otherPart = Part::factory()->create([
        'sku' => '654321'
    ]);

    Livewire::test(Index::class)
        ->assertSee($searchedFor->sku)
        ->assertSee($otherPart->sku)
        ->set('search', '123456')
        ->assertSee($searchedFor->sku)
        ->assertDontSee($otherPart->sku);
});

it('can find parts in a category', function () {
    $category1 = Category::factory()->create();
    $category2 = Category::factory()->create();

    $part1 = Part::factory()->create();
    $part1->categories()->attach($category1);
    $part2 = Part::factory()->create();
    $part2->categories()->attach($category2);

    Livewire::test(Index::class)
        ->assertSee($part1->sku)
        ->assertSee($part2->sku)
        ->set('category', $category1->name)
        ->assertSee($part1->sku)
        ->assertDontSee($part2->sku);
});

it('can add an item to the cart', function () {
    $this->actingAs($this->user);

    $part = Part::factory()->create();

    expect(auth()->user()->cart->items()->count())
        ->toBe(0);

    Livewire::test(Index::class)
        ->call('addToCart', $part->id)
        ->assertDispatched('item-added-to-cart')
        ->assertDispatched('notify');

    expect(auth()->user()->cart->items()->count())
        ->toBe(1);
});
