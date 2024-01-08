<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class Show extends Component
{
    public $cartItems;

    public function mount()
    {
        $this->cartItems = auth()->user()->cart
            ->items()->with(['cart', 'part'])->get();
    }

    #[On('reset-cart')]
    public function recalculate(): void
    {
        $this->cartItems = auth()->user()->cart
            ->items()->with(['cart', 'part'])->get();
    }

    public function render()
    {
        return view('livewire.cart.show', [
            'cart' => auth()->user()->cart
        ])
            ->layout('components.layouts.marketing');
    }
}
