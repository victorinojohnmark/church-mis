<?php

namespace App\Notifications\DocumentRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestDeath;

class NewDeathNotification extends Notification
{
    use Queueable;

    private $documentRequestDeath;

    public function __construct(DocumentRequestDeath $documentRequestDeath)
    {
        $this->documentRequestDeath = $documentRequestDeath;
    }

    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Death Document Request for '. $this->documentRequestDeath->name)
                ->greeting('Good day!')
                ->line('Death Document Request for '. $this->documentRequestDeath->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/documentrequestdeaths');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'document_request',
            'title' => 'New Death Document Request for '. $this->documentRequestDeath->name,
            'message' => 'Death Document Request for '. $this->documentRequestDeath->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/documentrequestdeaths'
        ];

    }
}
