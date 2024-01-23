<?php

namespace App\Livewire\Account;

use App\Models\FreightCarrier;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CarrierForm extends Component
{
    #[Validate('required')]
    public $name = '';

    #[Validate('required')]
    public $account_number = '';

    public function save()
    {
        $this->validate();

        auth()->user()->carriers()->save(
            FreightCarrier::make([
                'name' => $this->name,
                'account_number' => $this->account_number,
            ])
        );
        $this->reset();

        $this->dispatch('carrier-created');
    }

    public function render()
    {
        return view('livewire.account.carrier-form');
    }
}
