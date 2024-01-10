<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\DocumentRequest\DocumentRequestConfirmation;

class DocumentRequestConfirmationReadyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $documentRequestConfirmation;

    public function __construct(DocumentRequestConfirmation $documentRequestConfirmation)
    {
        $this->documentRequestConfirmation = $documentRequestConfirmation;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Confirmation document request for '. $this->documentRequestConfirmation->name)
                    ->greeting('Good day '. $this->documentRequestConfirmation->createdBy->name)
                    ->line('Your document request for ' . $this->documentRequestConfirmation->name . ' is now ready for pick up.')
                    ->line('Note:')
                    ->line('- Confirmation Certificate (with fee)')
                    ->line('- All the transactions are in Cash.')
                    ->line('')
                    ->line('Requirements:')
                    ->line('- Birth Certificate')
                    ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestconfirmations')
                    ;
    }


    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Confirmation document requested is ready',
            'message' => 'Your confirmation document request for ' . $this->documentRequestConfirmation->name . ' is now ready for pick up.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestconfirmations'
        ];
    }
}
