<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Funeral;

class FuneralAcceptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $funeral;

    public function __construct(Funeral $funeral)
    {
        $this->funeral = $funeral;
    }

    
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Funeral Reservation for '. $this->funeral->name)
                    ->greeting('Good day '. $this->funeral->createdBy->name)
                    ->line('Your funeral reservation for ' . $this->funeral->name . ' has been accepted.')
                    ->action('View reservation', env('APP_URL', 'localhost') . '/user/funerals')
                    ->line('Admin Message: ' . $this->funeral->accepted_message);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Funeral reservation accepted',
            'message' => 'Your funeral reservation for ' . $this->funeral->name . ' has been accepted.',
            'link' => env('APP_URL', 'localhost') . '/user/funerals'
        ];
    }
}
