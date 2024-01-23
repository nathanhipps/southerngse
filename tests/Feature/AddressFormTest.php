<?php

use App\Livewire\Account\AddressForm;
use App\Models\Address;
use Livewire\Livewire;

beforeEach(fn() => $this->setupAccount());

it('can save an address', function () {
    Livewire::actingAs($this->user)
        ->test(AddressForm::class)
        ->assertSet('name', '')
        ->assertSet('street', '')
        ->assertSet('details', '')
        ->assertSet('city', '')
        ->assertSet('state', '')
        ->assertSet('zip', '')
        ->set('name', 'Southern GSE')
        ->set('street', '123 Fake Street')
        ->set('details', 'Suite 101')
        ->set('city', 'Atlanta')
        ->set('state', 'Georgia')
        ->set('zip', '30000')
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('name', '')
        ->assertSet('street', '')
        ->assertSet('details', '')
        ->assertSet('city', '')
        ->assertSet('state', '')
        ->assertSet('zip', '')
        ->assertDispatched('address-created');

    expect(Address::count())->toBe(1)
        ->and(auth()->user()->addresses()->first())
        ->name->toBe('Southern GSE')
        ->street->toBe('123 Fake Street')
        ->details->toBe('Suite 101')
        ->city->toBe('Atlanta')
        ->state->toBe('Georgia')
        ->zip->toBe('30000');
});

it('requires a name', function () {
    expect(Address::count())->toBe(0);

    Livewire::actingAs($this->user)
        ->test(AddressForm::class)
        ->assertSet('name', '')
        ->assertSet('street', '')
        ->assertSet('details', '')
        ->assertSet('city', '')
        ->assertSet('state', '')
        ->assertSet('zip', '')
        ->set('street', '123 Fake Street')
        ->set('details', 'Suite 101')
        ->set('city', 'Atlanta')
        ->set('state', 'Georgia')
        ->set('zip', '30000')
        ->call('save')
        ->assertHasErrors(['name' => 'required']);

    expect(Address::count())->toBe(0);
});

it('requires a street', function () {
    expect(Address::count())->toBe(0);

    Livewire::actingAs($this->user)
        ->test(AddressForm::class)
        ->assertSet('name', '')
        ->assertSet('street', '')
        ->assertSet('details', '')
        ->assertSet('city', '')
        ->assertSet('state', '')
        ->assertSet('zip', '')
        ->set('name', 'Southern GSE')
        ->set('street', '')
        ->set('details', 'Suite 101')
        ->set('city', 'Atlanta')
        ->set('state', 'Georgia')
        ->set('zip', '30000')
        ->call('save')
        ->assertHasErrors(['street' => 'required']);

    expect(Address::count())->toBe(0);
});

it('does not require details', function () {
    Livewire::actingAs($this->user)
    ->test(AddressForm::class)
    ->assertSet('name', '')
    ->assertSet('street', '')
    ->assertSet('details', '')
    ->assertSet('city', '')
    ->assertSet('state', '')
    ->assertSet('zip', '')
    ->set('name', 'Southern GSE')
    ->set('street', '123 Fake Street')
    ->set('details', '')
    ->set('city', 'Atlanta')
    ->set('state', 'Georgia')
    ->set('zip', '30000')
    ->call('save')
    ->assertHasNoErrors()
    ->assertSet('name', '')
    ->assertSet('street', '')
    ->assertSet('details', '')
    ->assertSet('city', '')
    ->assertSet('state', '')
    ->assertSet('zip', '')
    ->assertDispatched('address-created');

expect(Address::count())->toBe(1)
    ->and(auth()->user()->addresses()->first())
    ->name->toBe('Southern GSE')
    ->street->toBe('123 Fake Street')
    ->details->toBe('')
    ->city->toBe('Atlanta')
    ->state->toBe('Georgia')
    ->zip->toBe('30000');
});

it('requires a city', function () {
    expect(Address::count())->toBe(0);

    Livewire::actingAs($this->user)
        ->test(AddressForm::class)
        ->assertSet('name', '')
        ->assertSet('street', '')
        ->assertSet('details', '')
        ->assertSet('city', '')
        ->assertSet('state', '')
        ->assertSet('zip', '')
        ->set('name', 'Southern GSE')
        ->set('street', '123 Fake Street')
        ->set('details', 'Suite 101')
        ->set('city', '')
        ->set('state', 'Georgia')
        ->set('zip', '30000')
        ->call('save')
        ->assertHasErrors(['city' => 'required']);

    expect(Address::count())->toBe(0);
});

it('requires a state', function () {
    expect(Address::count())->toBe(0);

    Livewire::actingAs($this->user)
        ->test(AddressForm::class)
        ->assertSet('name', '')
        ->assertSet('street', '')
        ->assertSet('details', '')
        ->assertSet('city', '')
        ->assertSet('state', '')
        ->assertSet('zip', '')
        ->set('name', 'Southern GSE')
        ->set('street', '123 Fake Street')
        ->set('details', 'Suite 101')
        ->set('city', 'Atlanta')
        ->set('state', '')
        ->set('zip', '30000')
        ->call('save')
        ->assertHasErrors(['state' => 'required']);

    expect(Address::count())->toBe(0);
});

it('requires a zip', function () {
    expect(Address::count())->toBe(0);

    Livewire::actingAs($this->user)
        ->test(AddressForm::class)
        ->assertSet('name', '')
        ->assertSet('street', '')
        ->assertSet('details', '')
        ->assertSet('city', '')
        ->assertSet('state', '')
        ->assertSet('zip', '')
        ->set('name', 'Southern GSE')
        ->set('street', '123 Fake Street')
        ->set('details', 'Suite 101')
        ->set('city', 'Atlanta')
        ->set('state', 'Georgia')
        ->set('zip', '')
        ->call('save')
        ->assertHasErrors(['zip' => 'required']);

    expect(Address::count())->toBe(0);
});
