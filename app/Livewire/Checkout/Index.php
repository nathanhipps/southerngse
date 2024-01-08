<?php

namespace App\Livewire\Checkout;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.checkout.index')
            ->layout('components.layouts.marketing');
    }
}
