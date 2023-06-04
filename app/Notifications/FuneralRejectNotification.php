<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Funeral;

class FuneralRejectNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $funeral;

    public function __construct(Funeral $funeral)
    {
        $this->funeral = $funeral;
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
                    ->subject('Funeral Reservation for '. $this->funeral->name)
                    ->greeting('Good day '. $this->funeral->createdBy->name)
                    ->line('Your funeral reservation for ' . $this->funeral->name . ' has been rejected.')
                    ->action('View reservation', url('/user/funerals'))
                    ->line('Admin Message: ' . $this->funeral->rejection_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Funeral reservation rejected',
            'message' => 'Your funeral reservation for ' . $this->funeral->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/funerals'
        ];
    }
}
