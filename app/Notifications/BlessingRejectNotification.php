<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Blessing;

class BlessingRejectNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $blessing;

    public function __construct(Blessing $blessing)
    {
        $this->blessing = $blessing;
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
                    ->subject('Blessing Reservation for '. $this->blessing->name)
                    ->greeting('Good day '. $this->blessing->createdBy->name)
                    ->line('Your blessing reservation for ' . $this->blessing->name . ' has been rejected.')
                    ->action('View reservation', url('/user/blessings'))
                    ->line('Admin Message: ' . $this->blessing->rejection_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Blessing reservation rejected',
            'message' => 'Your blessing reservation for ' . $this->blessing->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/blessings'
        ];
    }
}
