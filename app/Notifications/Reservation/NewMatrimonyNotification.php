<?php

namespace App\Notifications\Reservation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Matrimony;

class NewMatrimonyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $matrimony;

    public function __construct(Matrimony $matrimony)
    {
        $this->matrimony = $matrimony;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Matrimony Reservation for '. $this->matrimony->name)
                ->greeting('Good day!')
                ->line('Matrimony reservation for '. $this->matrimony->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/matrimonies');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'event',
            'title' => 'New Matrimony Reservation for '. $this->matrimony->name,
            'message' => 'Matrimony reservation for '. $this->matrimony->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/matrimonies'
        ];
    }
}
