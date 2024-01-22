<?php

namespace App\Notifications\Reservation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Communion;

class NewCommunionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $communion;

    public function __construct(Communion $communion)
    {
        $this->communion = $communion;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Holy First Communion Reservation for '. $this->communion->name)
                ->greeting('Good day!')
                ->line('Holy First Communion reservation for '. $this->communion->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/communions');
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
            'title' => 'New Holy First Communion Reservation for '. $this->communion->name,
            'message' => 'Holy First Communion reservation for '. $this->communion->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/communions'
        ];
    }
}
