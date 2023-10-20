<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestDeath;

class DocumentRequestDeathRejectNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
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
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Death document request for '. $this->documentRequestDeath->name)
            ->greeting('Good day '. $this->documentRequestDeath->createdBy->name)
            ->line('Your death document request for ' . $this->documentRequestDeath->name . ' has been rejected.')
            ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestdeaths')
            ->line('Admin Message: ' . $this->documentRequestDeath->rejection_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Death document request for '. $this->documentRequestDeath->name,
            'message' => 'Your death document request for ' . $this->documentRequestDeath->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestdeaths'
        ];
    }
}
