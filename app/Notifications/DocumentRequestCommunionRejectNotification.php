<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestCommunion;

class DocumentRequestCommunionRejectNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(DocumentRequestCommunion $documentRequestCommunion)
    {
        $this->documentRequestCommunion = $documentRequestCommunion;
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
            ->subject('Communion document request for '. $this->documentRequestCommunion->name)
            ->greeting('Good day '. $this->documentRequestCommunion->createdBy->name)
            ->line('Your communion document request for ' . $this->documentRequestCommunion->name . ' has been rejected.')
            ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestcommunions')
            ->line('Admin Message: ' . $this->documentRequestCommunion->rejection_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Communion document request for '. $this->documentRequestCommunion->name,
            'message' => 'Your communion document request for ' . $this->documentRequestCommunion->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestcommunions'
        ];
    }
}
