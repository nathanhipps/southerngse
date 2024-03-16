<?php

namespace App\Livewire;

use App\Models\Lead;
use App\Notifications\LeadReceived;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ServiceForm extends Component
{
    #[Rule('required')]
    public string $name = '';

    #[Rule('required|email')]
    public string $email = '';

    #[Rule('required')]
    public string $subject = '';

    #[Rule('required')]
    public string $message = '';

    public string $hp = '';

    public string $ts = '';

    public $messageLabel = null;

    #[On('set-subject')]
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    public function mount()
    {
        $this->ts = now();
    }

    public function submit(): void
    {
        if ($this->honeyPot()) {
            return;
        }

        $this->validate();

        $lead = Lead::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'data' => [
                'page' => 'Service Page'
            ],
        ]);

        $this->dispatch('notify', title: 'Success', message: 'Your service request has been submitted');

        Notification::route('mail', 'jason@southerngse.com')
            ->notify(new LeadReceived($lead));

        $this->reset();
    }

    public function honeyPot(): bool
    {
        if ($this->hp) {
            return true;
        }

        if (now()->subSeconds(3)->lessThan($this->ts)) {
            return true;
        }

        return false;
    }

    public function render()
    {
        return view('livewire.service-form');
    }
}
