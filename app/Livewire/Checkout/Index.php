<?php

namespace App\Livewire\Checkout;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public $action = '';
    public $address_id = '';
    public $carrier_id = '';
    public $card_id = '';
    public $deliveryTime = '';
    public $cart;

    public function mount()
    {
        if (auth()->user()->addresses()->count() === 1) {
            $this->address_id = auth()->user()->addresses()->first()->id;
        }

        if (auth()->user()->carriers()->count() === 1) {
            $this->carrier_id = auth()->user()->carriers()->first()->id;
        }

        if (auth()->user()->cards()->count() === 1) {
            $this->card_id = auth()->user()->cards()->first()->id;
        }

        $this->cart = auth()->user()->cart;
    }

    #[Computed]
    public function items(): Collection
    {
        return auth()->user()->cart->items()->with('part')->get();
    }

    #[Computed]
    public function canSubmit(): bool
    {
        return $this->address_id
            && ($this->carrier_id || auth()->user()->carriers()->count() === 0)
            && $this->deliveryTime
            && $this->card_id;
    }

    public function submit()
    {
        dd('submitted');
    }

    public function render()
    {
        return view('livewire.checkout.index', [
            'addresses' => auth()->user()->addresses,
            'cards' => auth()->user()->cards,
            'carriers' => auth()->user()->carriers,
            'items' => $this->items,
            'canSubmit' => $this->canSubmit,
        ])
            ->layout('components.layouts.marketing');
    }
}
