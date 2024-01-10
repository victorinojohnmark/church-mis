<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Reservation\Baptism;

class BaptismAcceptNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $baptism;

    public function __construct(Baptism $baptism)
    {
        $this->baptism = $baptism;
    }

    
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Baptism Reservation for '. $this->baptism->name)
                    ->greeting('Good day '. $this->baptism->createdBy->name)
                    ->line('Your baptism reservation for ' . $this->baptism->name . ' has been accepted.')
                    
                    ->line('Admin Message: ' . $this->baptism->accepted_message)
                    ->line('Note:')
                    ->line('- Regular and Special Baptism (with fees)')
                    ->line('- All transactions are in Cash.')
                    ->line('')
                    ->line('Requirements:')
                    ->line('- Birth Certificate of the Child')
                    ->line('- Marriage Contract of the Parents (if married)')
                    ->action('View reservation', env('APP_URL', 'localhost') . '/user/baptisms')
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
            'title' => 'Baptism reservation accepted',
            'message' => 'Your baptism reservation for ' . $this->baptism->name . ' has been accepted.',
            'link' => env('APP_URL', 'localhost') . '/user/baptisms'
        ];
    }
}
