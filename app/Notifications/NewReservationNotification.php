<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReservationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $detail;

    public function __construct($detail)
    {
        $this->detail = $detail;
    }

    
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('New reservation from ' . $this->detail['user'])
                    ->greeting('Good day!')
                    ->line('Reservation of ' . $this->detail['transaction'] . ' was requested by ' . $this->detail['user'] . ' on ' . $this->detail['date'])
                    ->action('View Baptism Reservations List', env('APP_URL', 'localhost') . $this->detail['url']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New ' . $this->detail['transaction'] . ' reservation accepted',
            'message' => $this->detail['transaction'] . ' reservation was requested by ' . $this->detail['user'] . ' on ' . $this->detail['date'],
            'link' => env('APP_URL', 'localhost') . $this->detail['url']
        ];
    }
}
