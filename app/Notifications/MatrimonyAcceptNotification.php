<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Matrimony;

class MatrimonyAcceptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $matrimony;

    public function __construct(Matrimony $matrimony)
    {
        $this->matrimony = $matrimony;
    }

    
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Matrimony Reservation for '. $this->matrimony->grooms_name . ' and ' . $this->matrimony->brides_name)
                    ->greeting('Good day '. $this->matrimony->createdBy->name)
                    ->line('Your matrimony reservation for ' . $this->matrimony->grooms_name . ' and ' . $this->matrimony->brides_name . ' has been accepted.')
                    ->action('View reservation', env('APP_URL', 'localhost') . '/user/matrimonies')
                    ->line('Admin Message: ' . $this->matrimony->accepted_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Matrimony reservation accepted',
            'message' => 'Your matrimony reservation for ' . $this->matrimony->grooms_name . ' and ' . $this->matrimony->brides_name . ' has been accepted.',
            'link' => env('APP_URL', 'localhost') . '/user/matrimonies'
        ];
    }
}
