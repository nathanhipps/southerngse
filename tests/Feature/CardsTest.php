<?php

use App\Livewire\Account\Cards;
use App\Models\Card;
use Livewire\Livewire;

beforeEach(fn() => $this->setupAccount());

it('can display all user cards', function () {
    $this->actingAs($this->user);

    $cards = Card::factory(2)->create([
        'user_id' => $this->user->id
    ]);

    $otherCard = Card::factory()->create();

    Livewire::test(Cards::class)
        ->assertSee($cards[0]->last_four)
        ->assertSee($cards[1]->last_four)
        ->assertDontSee($otherCard->last_four);
});

it('can start a new card', function () {
    Livewire::actingAs($this->user)
        ->test(Cards::class)
        ->assertSet('slider', false)
        ->call('startNewCard')
        ->assertSet('slider', 'true')
        ->assertDispatched('lock-scroll');
});
