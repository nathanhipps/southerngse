<?php

namespace App\Livewire\Account;

use Livewire\Attributes\On;
use Livewire\Component;

class Carriers extends Component
{
    public $slider = false;

    #[On('carrier-created')]
    public function reload(): void
    {
        $this->reset();
    }

    public function startNewCarrier(): void
    {
        $this->slider = true;
        $this->dispatch('lock-scroll');
    }

    public function deleteCarrier($id): void
    {
        auth()->user()->carriers()->where('id', $id)->first()?->delete();
    }

    public function render()
    {
        return view('livewire.account.carriers', [
            'carriers' => auth()->user()->carriers
        ]);
    }
}
