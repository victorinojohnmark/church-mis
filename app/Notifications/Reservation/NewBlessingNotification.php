<?php

namespace App\Notifications\Reservation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Blessing;

class NewBlessingNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $blessing;

    public function __construct(Blessing $blessing)
    {
        $this->blessing = $blessing;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Blessing Reservation for '. $this->blessing->name)
                ->greeting('Good day!')
                ->line('Blessing reservation for '. $this->blessing->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/blessings');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Blessing Reservation for '. $this->blessing->name,
            'message' => 'Blessing reservation for '. $this->blessing->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/blessings'
        ];
    }
}
