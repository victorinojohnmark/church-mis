<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\DocumentRequest\DocumentRequestBaptism;

class DocumentRequestBaptismReadyNotification extends Notification
{
    use Queueable;

    private $documentRequestBaptism;

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
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Baptism document request for '. $this->documentRequestBaptism->name)
                    ->greeting('Good day '. $this->documentRequestBaptism->createdBy->name)
                    ->line('Your document request for ' . $this->documentRequestBaptism->name . ' is now ready for pick up.')
                    ->action('View request', url('/user/documentrequestbaptisms'))
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
            'title' => 'Baptism document requested is ready',
            'message' => 'Your baptism document request for ' . $this->documentRequestBaptism->name . ' is now ready for pick up.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestbaptisms'
        ];
    }
}
