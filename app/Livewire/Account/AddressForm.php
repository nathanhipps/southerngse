<?php

namespace App\Livewire\Account;

use App\Models\Address;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddressForm extends Component
{
    #[Validate('required')]
    public $name = '';

    #[Validate('required')]
    public $street = '';

    public $details = '';

    #[Validate('required')]
    public $city = '';

    #[Validate('required')]
    public $state = '';

    #[Validate('required')]
    public $zip = '';

    public function save()
    {
        $this->validate();

        auth()->user()->addresses()->save(
            $address = Address::make([
                'name' => $this->name,
                'street' => $this->street,
                'details' => $this->details,
                'city' => $this->city,
                'state' => $this->state,
                'zip' => $this->zip,
            ])
        );
        $this->reset();

        $this->dispatch('address-created', addressId: $address->id);
    }

    public function render()
    {
        return view('livewire.account.address-form');
    }
}
