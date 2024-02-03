<?php

namespace App\Livewire\Account;

use App\Models\Order;
use Livewire\Component;

class OrderShow extends Component
{
    public Order $order;

    public function render()
    {
        return view('livewire.account.order-show');
    }
}
