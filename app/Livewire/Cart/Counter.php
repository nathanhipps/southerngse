<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class Counter extends Component
{
    public $show = false;

    public function mount(): void
    {
        $this->show = Cart::hasItems();
    }

    #[On('item-added-to-cart')]
    public function showCounter(): void
    {
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.cart.counter');
    }
}
