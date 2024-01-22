<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Confirmation;

class ConfirmationAcceptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $confirmation;

    public function __construct(Confirmation $confirmation)
    {
        $this->confirmation = $confirmation;
    }

    
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Confirmation Reservation for '. $this->confirmation->name)
                    ->greeting('Good day '. $this->confirmation->createdBy->name)
                    ->line('Your confirmation reservation for ' . $this->confirmation->name . ' has been accepted.')
                    ->action('View reservation', env('APP_URL', 'localhost') . '/user/confirmations')
                    ->line('Admin Message: ' . $this->confirmation->accepted_message);
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
            'title' => 'Confirmation reservation accepted',
            'message' => 'Your confirmation reservation for ' . $this->confirmation->name . ' has been accepted.',
            'link' => env('APP_URL', 'localhost') . '/user/confirmations'
        ];
    }
}
