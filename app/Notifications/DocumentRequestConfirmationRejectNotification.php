<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestConfirmation;

class DocumentRequestConfirmationRejectNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(DocumentRequestConfirmation $documentRequestConfirmation)
    {
        $this->documentRequestConfirmation = $documentRequestConfirmation;
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
            ->subject('Comfirmation document request for '. $this->documentRequestConfirmation->name)
            ->greeting('Good day '. $this->documentRequestConfirmation->createdBy->name)
            ->line('Your confirmation document request for ' . $this->documentRequestConfirmation->name . ' has been rejected.')
            ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestconfirmations')
            ->line('Admin Message: ' . $this->documentRequestConfirmation->rejection_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'document_request',
            'title' => 'Comfirmation document request for '. $this->documentRequestConfirmation->name,
            'message' => 'Your confirmation document request for ' . $this->documentRequestConfirmation->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestconfirmations'
        ];
    }
}
