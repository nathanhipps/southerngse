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

    #[On('add-to-cart')]
    public function showCounter($id): void
    {
        ray($id);
        $this->show = true;
    }

    public function render()
    {
        return view('livewire.cart.counter');
    }
}
