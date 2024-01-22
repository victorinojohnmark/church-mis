<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestBaptism;

class DocumentRequestBaptismRejectNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(DocumentRequestBaptism $documentRequestBaptism)
    {
        $this->documentRequestBaptism = $documentRequestBaptism;
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
            ->subject('Baptism document request for '. $this->documentRequestBaptism->name)
            ->greeting('Good day '. $this->documentRequestBaptism->createdBy->name)
            ->line('Your baptism document request for ' . $this->documentRequestBaptism->name . ' has been rejected.')
            ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestbaptisms')
            ->line('Admin Message: ' . $this->documentRequestBaptism->rejection_message);
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
            'title' => 'Baptism document request for '. $this->documentRequestBaptism->name,
            'message' => 'Your baptism document request for ' . $this->documentRequestBaptism->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestbaptisms'
        ];
    }
}
