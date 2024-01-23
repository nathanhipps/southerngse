<?php

namespace App\Livewire\Account;

use Livewire\Attributes\On;
use Livewire\Component;

class Addresses extends Component
{
    public $slider = false;

    #[On('address-created')]
    public function reload(): void
    {
        $this->reset();
    }

    public function startNewAddress(): void
    {
        $this->slider = true;
        $this->dispatch('lock-scroll');
    }

    public function deleteAddress($id): void
    {
        auth()->user()->addresses()->where('id', $id)->first()?->delete();
    }

    public function render()
    {
        return view('livewire.account.addresses', [
            'addresses' => auth()->user()->addresses,
        ]);
    }
}
