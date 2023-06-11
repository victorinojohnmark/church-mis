<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Confirmation;

class ConfirmationRejectNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $confirmation;

    public function __construct(Confirmation $confirmation)
    {
        $this->confirmation = $confirmation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Confirmation Reservation for '. $this->confirmation->name)
                    ->greeting('Good day '. $this->confirmation->createdBy->name)
                    ->line('Your confirmation reservation for ' . $this->confirmation->name . ' has been rejected.')
                    ->action('View reservation', env('APP_URL', 'localhost') . '/user/confirmations')
                    ->line('Admin Message: ' . $this->confirmation->rejection_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Confirmation reservation rejected',
            'message' => 'Your confirmation reservation for ' . $this->confirmation->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/confirmations'
        ];
    }
}
