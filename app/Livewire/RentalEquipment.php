<?php

namespace App\Livewire;

use App\Models\Rental;
use Livewire\Component;

class RentalEquipment extends Component
{
    public function setSubject($subject)
    {
        $this->dispatch('set-subject', subject: $subject);
    }

    public function render()
    {
        return view('livewire.rental-equipment', [
            'equipment' => Rental::query()->paginate(20)
        ]);
    }
}
