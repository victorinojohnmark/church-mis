<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\DocumentRequest\DocumentRequestMatrimony;

class DocumentRequestMatrimonyReadyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $documentRequestMatrimony;

    public function __construct(DocumentRequestMatrimony $documentRequestMatrimony)
    {
        $this->documentRequestMatrimony = $documentRequestMatrimony;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Matrimony document request for '. $this->documentRequestMatrimony->grooms_name . ' and ' . $this->documentRequestMatrimony->brides_name)
                    ->greeting('Good day '. $this->documentRequestMatrimony->createdBy->name)
                    ->line('Your document request for ' . $this->documentRequestMatrimony->grooms_name . ' and ' . $this->documentRequestMatrimony->brides_name . ' is now ready for pick up.')
                    ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestmatrimonies')
                    ->line('Please prepare the following requirements: PSA and Valid ID for verification.')
                    ->line('Request Fee: Php 0.00');
    }


    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'document_request',
            'title' => 'Matrimony document requested is ready',
            'message' => 'Your matrimony document request for ' . $this->documentRequestMatrimony->grooms_name . ' and ' . $this->documentRequestMatrimony->brides_name . ' is now ready for pick up.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestmatrimonies'
        ];
    }
}
