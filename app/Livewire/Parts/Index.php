<?php

namespace App\Livewire\Parts;

use App\Models\Category;
use App\Models\Part;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    #[Url]
    public $category = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    #[Computed]
    public function parts()
    {
        return Part::query()
            ->when($this->category, function ($query) {
                return $query->whereHas('categories', fn($query) => $query->where('name', $this->category));
            })
            ->when($this->search, fn($query) => $query->search($this->search))
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.parts.index', [
            'parts' => $this->parts,
            'categories' => Category::query()
                ->withCount('parts')
                ->get(),
        ])
            ->layout('components.layouts.marketing');
    }
}
