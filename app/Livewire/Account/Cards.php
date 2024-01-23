<?php

namespace App\Livewire\Account;

use Livewire\Attributes\On;
use Livewire\Component;

class Cards extends Component
{
    public $slider = false;

    #[On('card-created')]
    public function reload(): void
    {
        $this->reset();
    }

    public function startNewCard(): void
    {
        $this->slider = true;
        $this->dispatch('lock-scroll');
    }

    public function deleteACard($id): void
    {
        auth()->user()->cards()->where('id', $id)->first()?->delete();
    }

    public function render()
    {
        return view('livewire.account.cards', [
            'cards' => auth()->user()->cards,
        ]);
    }
}
