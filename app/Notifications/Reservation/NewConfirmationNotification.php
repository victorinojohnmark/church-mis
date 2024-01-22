<?php

namespace App\Notifications\Reservation;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Confirmation;

class NewConfirmationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $confirmation;

    public function __construct(Confirmation $confirmation)
    {
        $this->confirmation = $confirmation;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Confirmation Reservation for '. $this->confirmation->name)
                ->greeting('Good day!')
                ->line('Confirmation reservation for '. $this->confirmation->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/confirmations');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'event',
            'title' => 'New Confirmation Reservation for '. $this->confirmation->name,
            'message' => 'Confirmation reservation for '. $this->confirmation->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/confirmations'
        ];
    }
}
