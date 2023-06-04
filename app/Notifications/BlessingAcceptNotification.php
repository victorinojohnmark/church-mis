<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Blessing;

class BlessingAcceptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $blessing;

    public function __construct(Blessing $blessing)
    {
        $this->blessing = $blessing;
    }

    
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Blessing Reservation for '. $this->blessing->name)
                    ->greeting('Good day '. $this->blessing->createdBy->name)
                    ->line('Your blessing reservation for ' . $this->blessing->name . ' has been accepted.')
                    ->action('View reservation', url('/user/blessings'))
                    ->line('Admin Message: ' . $this->blessing->accepted_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Blessing reservation accepted',
            'message' => 'Your blessing reservation for ' . $this->blessing->name . ' has been accepted.',
            'link' => env('APP_URL', 'localhost') . '/user/blessings'
        ];
    }
}
