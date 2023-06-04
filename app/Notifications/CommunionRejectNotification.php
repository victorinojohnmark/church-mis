<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Communion;

class CommunionRejectNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $communion;

    public function __construct(Communion $communion)
    {
        $this->communion = $communion;
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
                    ->subject('Communion Reservation for '. $this->communion->name)
                    ->greeting('Good day '. $this->communion->createdBy->name)
                    ->line('Your communion reservation for ' . $this->communion->name . ' has been rejected.')
                    ->action('View reservation', url('/user/communions'))
                    ->line('Admin Message: ' . $this->communion->rejection_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Communion reservation rejected',
            'message' => 'Your communion reservation for ' . $this->communion->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/communions'
        ];
    }
}
