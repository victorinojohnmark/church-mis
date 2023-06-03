<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\DocumentRequest\DocumentRequestCommunion;

class DocumentRequestCommunionReadyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $documentRequestCommunion;

    public function __construct(DocumentRequestCommunion $documentRequestCommunion)
    {
        $this->documentRequestCommunion = $documentRequestCommunion;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Communion document request for '. $this->documentRequestCommunion->name)
                    ->greeting('Good day '. $this->documentRequestCommunion->createdBy->name)
                    ->line('Your document request for ' . $this->documentRequestCommunion->name . ' is now ready for pick up.')
                    ->action('View request', url('/user/documentrequestcommunions'))
                    ->line('Please prepare the following requirements: PSA and Valid ID for verification.')
                    ->line('Request Fee: Php 0.00');
    }


    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Communion document requested is ready',
            'message' => 'Your communion document request for ' . $this->documentRequestCommunion->name . ' is now ready for pick up.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestcommunions'
        ];
    }
}
