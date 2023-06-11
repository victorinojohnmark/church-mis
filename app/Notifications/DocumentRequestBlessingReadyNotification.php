<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\DocumentRequest\DocumentRequestBlessing;

class DocumentRequestBlessingReadyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $documentRequestBlessing;

    public function __construct(DocumentRequestBlessing $documentRequestBlessing)
    {
        $this->documentRequestBlessing = $documentRequestBlessing;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Blessing document request for '. $this->documentRequestBlessing->name)
                    ->greeting('Good day '. $this->documentRequestBlessing->createdBy->name)
                    ->line('Your document request for ' . $this->documentRequestBlessing->name . ' is now ready for pick up.')
                    ->action('View request', env('APP_URL', 'localhost') . '/user/documentrequestblessings')
                    ->line('Please prepare a copy of your Valid ID for verification.')
                    ->line('Request Fee: Php 0.00');
    }


    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Blessing document requested is ready',
            'message' => 'Your blessing document request for ' . $this->documentRequestBlessing->name . ' is now ready for pick up.',
            'link' => env('APP_URL', 'localhost') . '/user/documentrequestblessings'
        ];
    }
}
