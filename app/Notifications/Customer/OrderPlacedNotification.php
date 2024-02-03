<?php

namespace App\Notifications\Customer;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    public function __construct(
        readonly Order $order
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting($this->order->user->name.',')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Order #'.$this->order->number.'was received')
            ->line('Thank you for your order. We will process and ship as soon as possible.')
            ->action('View Order', url(route('order', ['order' => $this->order])));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
