<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use App\Models\Part;
use Livewire\Component;

class Button extends Component
{
    public Part $part;

    public function add()
    {
        Cart::addItem($this->part);

        ray(session()->all());
    }

    public function render()
    {
        return view('livewire.cart.button');
    }
}
