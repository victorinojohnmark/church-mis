<?php

namespace App\Notifications\Reservation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Reservation\Funeral;

class NewFuneralNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $funeral;

    public function __construct(Funeral $funeral)
    {
        $this->funeral = $funeral;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Funeral Reservation for '. $this->funeral->name)
                ->greeting('Good day!')
                ->line('Funeral reservation for '. $this->funeral->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/funerals');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Funeral Reservation for '. $this->funeral->name,
            'message' => 'Funeral reservation for '. $this->funeral->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/funerals'
        ];
    }
}
