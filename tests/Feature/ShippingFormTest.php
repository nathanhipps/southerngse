<?php

use App\Livewire\Account\CarrierForm;
use App\Models\FreightCarrier;
use Livewire\Livewire;

beforeEach(fn() => $this->setupAccount());

it('can create a new carrier', function () {
    Livewire::actingAs($this->user)
        ->test(CarrierForm::class)
        ->assertSet('name', '')
        ->assertSet('account_number', '')
        ->set('name', 'FedEx')
        ->set('account_number', '123456')
        ->call('save')
        ->assertSet('name', '')
        ->assertSet('account_number', '')
        ->assertDispatched('carrier-created');

    expect(FreightCarrier::count())->toBe(1)
        ->and(auth()->user()->carriers()->first())
        ->name->toBe('FedEx')
        ->account_number->toBe('123456');
});

it('must have a name', function () {
    Livewire::actingAs($this->user)
        ->test(CarrierForm::class)
        ->assertSet('name', '')
        ->assertSet('account_number', '')
        ->set('account_number', '123456')
        ->call('save')
        ->assertHasErrors(['name' => 'required'])
        ->assertSet('name', '')
        ->assertSet('account_number', '123456')
        ->assertNotDispatched('carrier-created');
});

it('must have an account_number', function () {
    Livewire::actingAs($this->user)
        ->test(CarrierForm::class)
        ->assertSet('name', '')
        ->assertSet('account_number', '')
        ->set('name', 'FedEx')
        ->call('save')
        ->assertHasErrors(['account_number' => 'required'])
        ->assertSet('name', 'FedEx')
        ->assertSet('account_number', '')
        ->assertNotDispatched('carrier-created');
});
