<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\DocumentRequest;

class DocumentRequestReadyNotification extends Notification
{
    use Queueable;

    private $documentRequest;

    public function __construct(DocumentRequest $documentRequest)
    {
        $this->documentRequest = $documentRequest;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Document Request for '. $this->documentRequest->name)
                    ->greeting('Good day '. $this->documentRequest->createdBy->name)
                    ->line('Your document request for ' . $this->documentRequest->name . ' is now ready for pick up.')
                    ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequest')
                    ->line('Please prepare the following requirements: PSA and Valid ID.')
                    ->line('Payment details here');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Document requested is ready',
            'message' => 'Your document request for ' . $this->documentRequest->name . ' is now ready for pick up.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequest'
        ];
    }
}
