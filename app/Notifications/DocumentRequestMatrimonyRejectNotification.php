<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestMatrimony;

class DocumentRequestMatrimonyRejectNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(DocumentRequestMatrimony $documentRequestMatrimony)
    {
        $this->documentRequestMatrimony = $documentRequestMatrimony;
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
            ->subject('Matrimony document request for '. $this->documentRequestMatrimony->name)
            ->greeting('Good day '. $this->documentRequestMatrimony->createdBy->name)
            ->line('Your matrimony document request for ' . $this->documentRequestMatrimony->name . ' has been rejected.')
            ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestmatrimonies')
            ->line('Admin Message: ' . $this->documentRequestMatrimony->rejection_message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Matrimony document request for '. $this->documentRequestMatrimony->name,
            'message' => 'Your matrimony document request for ' . $this->documentRequestMatrimony->grooms_name . ' and ' . $this->documentRequestMatrimony->brides_name . ' has been rejected.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestmatrimonies'
        ];
    }
}
