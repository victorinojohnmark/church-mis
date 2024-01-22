<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestBlessing;

class DocumentRequestBlessingRejectNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(DocumentRequestBlessing $documentRequestBlessing)
    {
        $this->documentRequestBlessing = $documentRequestBlessing;
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
            ->subject('Blessing document request for '. $this->documentRequestBlessing->name)
            ->greeting('Good day '. $this->documentRequestBlessing->createdBy->name)
            ->line('Your blessing document request for ' . $this->documentRequestBlessing->name . ' has been rejected.')
            ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestblessings')
            ->line('Admin Message: ' . $this->documentRequestBlessing->rejection_message);
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
            'title' => 'Blessing document request for '. $this->documentRequestBlessing->name,
            'message' => 'Your blessing document request for ' . $this->documentRequestBlessing->name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestblessings'
        ];
    }
}
