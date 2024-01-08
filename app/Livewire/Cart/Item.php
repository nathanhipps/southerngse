<?php

namespace App\Livewire\Cart;

use App\Models\CartItem;
use Livewire\Component;

class Item extends Component
{
    public CartItem $item;
    public $quantity;

    public function updatedQuantity()
    {
        $this->item->update(['quantity' => $this->quantity]);
        $this->dispatch('reset-cart');
    }

    public function remove()
    {
        $this->item->delete();
        $this->dispatch('reset-cart');
    }

    public function mount()
    {
        $this->quantity = $this->item->quantity;
    }

    public function render()
    {
        return view('livewire.cart.item');
    }
}
