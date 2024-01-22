<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Matrimony;

class MatrimonyRejectNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $matrimony;

    public function __construct(Matrimony $matrimony)
    {
        $this->matrimony = $matrimony;
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
                    ->subject('Matrimony Reservation for '. $this->matrimony->grooms_name . ' and ' . $this->matrimony->brides_name)
                    ->greeting('Good day '. $this->matrimony->createdBy->name)
                    ->line('Your matrimony reservation for ' . $this->matrimony->grooms_name . ' and ' . $this->matrimony->brides_name . ' has been rejected.')
                    ->action('View reservation', env('APP_URL', 'localhost') . '/user/matrimonies')
                    ->line('Admin Message: ' . $this->matrimony->rejection_message);
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
            'title' => 'Matrimony reservation rejected',
            'message' => 'Your matrimony reservation for ' . $this->matrimony->grooms_name . ' and ' . $this->matrimony->brides_name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/matrimonies'
        ];
    }
}
