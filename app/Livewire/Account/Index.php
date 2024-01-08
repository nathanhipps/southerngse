<?php

namespace App\Livewire\Account;

use Livewire\Component;

class Index extends Component
{
    public $page = 'addresses';

    public function changePage($page): void
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.account.index')
            ->layout('components.layouts.marketing');
    }
}
