<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeadReceived extends Notification
{
    use Queueable;

    public function __construct(readonly Lead $lead)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Lead Received')
            ->line('A new lead was submitted')
            ->action('View Lead', url('/admin/leads/'.$this->lead?->id));
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
