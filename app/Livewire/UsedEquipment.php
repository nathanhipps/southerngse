<?php

namespace App\Livewire;

use App\Models\UsedEquipment as Equipment;
use Livewire\Component;
use Livewire\WithPagination;

class UsedEquipment extends Component
{
    use WithPagination;

    public function setSubject($subject)
    {
        $this->dispatch('set-subject', subject: $subject);
    }

    public function render()
    {
        return view('livewire.used-equipment', [
            'equipment' => Equipment::query()->paginate(20)
        ]);
    }
}
