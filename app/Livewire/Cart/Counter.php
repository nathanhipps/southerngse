<?php

namespace App\Livewire\Cart;

use Livewire\Component;

class Counter extends Component
{
    public array $cart = [];

    public function mount()
    {
        $this->cart = request()->cookie('southern_gse_cart') ?? [];
    }

    public function render()
    {
        return view('livewire.cart.counter');
    }
}
