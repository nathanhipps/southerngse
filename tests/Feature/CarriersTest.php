<?php

use App\Livewire\Account\Carriers;
use App\Models\FreightCarrier;
use Livewire\Livewire;

beforeEach(fn() => $this->setupAccount());

it('has carriers page', function () {
    $carriers = FreightCarrier::factory(2)->create([
        'user_id' => $this->user->id,
    ]);

    $otherCarrier = FreightCarrier::factory()->create();

    Livewire::actingAs($this->user)
        ->test(Carriers::class)
        ->assertSee($carriers[0]->account_number)
        ->assertSee($carriers[1]->account_number)
        ->assertDontSee($otherCarrier->account_number);
});

it('can start a new carrier', function () {
    Livewire::actingAs($this->user)
        ->test(Carriers::class)
        ->assertSet('slider', false)
        ->call('startNewCarrier')
        ->assertSet('slider', true)
        ->assertDispatched('lock-scroll');
});
