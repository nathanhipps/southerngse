<?php

namespace App\Livewire\Account;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.account.orders', [
            'orders' => auth()->user()->orders()->paginate(5)
        ]);
    }
}
