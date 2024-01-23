<?php

use App\Livewire\Account\Addresses;
use App\Models\Address;
use Livewire\Livewire;

beforeEach(fn() => $this->setupAccount());

it('displays all user addresses', function () {
    $this->actingAs($this->user);

    $addresses = Address::factory(2)->create([
        'user_id' => $this->user->id
    ]);

    $otherAddress = Address::factory()->create();

    Livewire::test(Addresses::class)
        ->assertSee($addresses[0]->street)
        ->assertSee($addresses[1]->street)
        ->assertDontSee($otherAddress->street);
});

it('can trigger the start of a new address', function () {
    Livewire::actingAs($this->user)
        ->test(Addresses::class)
        ->assertSet('slider', false)
        ->call('startNewAddress')
        ->assertSet('slider', true)
        ->assertDispatched('lock-scroll');
});
