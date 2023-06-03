<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\DocumentRequest\DocumentRequestDeath;

class DocumentRequestDeathReadyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $documentRequestDeath;

    public function __construct(DocumentRequestDeath $documentRequestDeath)
    {
        $this->documentRequestDeath = $documentRequestDeath;
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
                    ->subject('Death document request for '. $this->documentRequestDeath->name)
                    ->greeting('Good day '. $this->documentRequestDeath->createdBy->name)
                    ->line('Your document request for ' . $this->documentRequestDeath->name . ' is now ready for pick up.')
                    ->action('View request', url('/user/documentrequestdeaths'))
                    ->line('Please prepare the following requirements: PSA and Valid ID for verification.')
                    ->line('Request Fee: Php 0.00');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Death document requested is ready',
            'message' => 'Your Death document request for ' . $this->documentRequestDeath->name . ' is now ready for pick up.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestdeaths'
        ];
    }
}
