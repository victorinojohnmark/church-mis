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
                    ->line('Admin Message: ' . $this->matrimony->accepted_message)
                    ->line('Note:')
                    ->line('- Reservation Fee – 500 (non-refundable but deductible from the marriage donation)')
                    ->line('- All the transactions are in Cash.')
                    ->line('')
                    ->line('Requirements:')
                    ->line('- Marriage License (No license, No Marriage)')
                    ->line('- CENOMAR')
                    ->line('- Baptismal Certificate')
                    ->line('- Confirmation Certificate')
                    ->line('- Birth Certificate')
                    ->action('View reservation', env('APP_URL', 'localhost') . '/user/matrimonies')
                    ;
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
