<?php

namespace App\Notifications\DocumentRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestConfirmation;

class NewConfirmationNotification extends Notification
{
    use Queueable;

    private $documentRequestConfirmation;

    public function __construct(DocumentRequestConfirmation $documentRequestConfirmation)
    {
        $this->documentRequestConfirmation = $documentRequestConfirmation;
    }

    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Confirmation Document Request for '. $this->documentRequestConfirmation->name)
                ->greeting('Good day!')
                ->line('Confirmation Document Request for '. $this->documentRequestConfirmation->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/documentrequestconfirmations');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Confirmation Document Request for '. $this->documentRequestConfirmation->name,
            'message' => 'Confirmation Document Request for '. $this->documentRequestConfirmation->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/documentrequestconfirmations'
        ];

    }
}
