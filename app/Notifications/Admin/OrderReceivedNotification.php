<?php

namespace App\Notifications\Admin;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderReceivedNotification extends Notification
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
            ->subject('Order #'.$this->order->number.'was placed by '.$this->order->user->name)
            ->line('A new order was just placed.')
            ->action('View Order', url('/admin/orders/'.$this->order->id));
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
