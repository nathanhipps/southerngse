<?php

namespace App\Livewire\Account;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.account.index')
            ->layout('components.layouts.marketing');
    }
}
