<?php

namespace App\Livewire\Account;

use App\Models\Card;
use Livewire\Component;

class CardForm extends Component
{
    public function createCard($card)
    {
        $card = Card::createFromInput($card);

        $this->dispatch('card-created', cardId: $card->id);

    }

    public function render()
    {
        return view('livewire.account.card-form');
    }
}
