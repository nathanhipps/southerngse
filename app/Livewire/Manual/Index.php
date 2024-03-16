<?php

namespace App\Livewire\Manual;

use App\Models\Manual;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function clearSearch()
    {
        $this->search = '';
    }

    #[Computed]
    public function manuals()
    {
        return Manual::query()
            ->when($this->search, function ($query) {
                return $query->search($this->search);
            })
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.manual.index', [
            'manuals' => $this->manuals,
        ]);
    }
}
