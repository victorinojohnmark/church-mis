<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Communion;

class CommunionAcceptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $communion;

    public function __construct(Communion $communion)
    {
        $this->communion = $communion;
    }

    
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Communion Reservation for '. $this->communion->name)
                    ->greeting('Good day '. $this->communion->createdBy->name)
                    ->line('Your communion reservation for ' . $this->communion->name . ' has been accepted.')
                    ->action('View reservation', env('APP_URL', 'localhost') . '/user/communions')
                    ->line('Admin Message: ' . $this->communion->accepted_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Communion reservation accepted',
            'message' => 'Your communion reservation for ' . $this->communion->name . ' has been accepted.',
            'link' => env('APP_URL', 'localhost') . '/user/communions'
        ];
    }
}
