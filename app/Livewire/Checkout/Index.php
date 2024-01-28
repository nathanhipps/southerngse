<?php

namespace App\Livewire\Checkout;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $action = '';
    public $address_id = '';
    public $carrier_id = '';
    public $card_id = '';
    public $deliveryTime = '';
    public $slider = false;
    public $cart;
    public $notes = '';

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

    public function startAction($action): void
    {
        $this->action = $action;
        $this->slider = true;
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

    #[On('address-created')]
    public function handleNewAddress($addressId): void
    {
        $this->slider = false;

        if (auth()->user()->addresses()->find($addressId)) {
            $this->address_id = $addressId;
        }
    }

    #[On('card-created')]
    public function handleNewCard($cardId): void
    {
        $this->slider = false;

        if (auth()->user()->cards()->find($cardId)) {
            $this->card_id = $cardId;
        }
    }

    #[On('carrier-created')]
    public function handleNewCarrier($carrierId): void
    {
        $this->slider = false;

        if (auth()->user()->carriers()->find($carrierId)) {
            $this->carrier_id = $carrierId;
        }
    }

    public function submit()
    {
        Order::process(
            cartId: $this->cart->id,
            addressId: $this->address_id,
            cardId: $this->card_id,
            deliveryTime: $this->deliveryTime,
            carrierId: $this->carrier_id,
        );
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
