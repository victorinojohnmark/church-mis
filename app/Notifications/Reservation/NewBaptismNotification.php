<?php

namespace App\Notifications\Reservation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation\Baptism;

class NewBaptismNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $baptism;

    public function __construct(Baptism $baptism)
    {
        $this->baptism = $baptism;
    }

    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Baptism Reservation for '. $this->baptism->name)
                ->greeting('Good day!')
                ->line('Baptism reservation for '. $this->baptism->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/baptisms');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'event',
            'title' => 'New Baptism Reservation for '. $this->baptism->name,
            'message' => 'Baptism reservation for '. $this->baptism->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/baptisms'
        ];

    }
}
