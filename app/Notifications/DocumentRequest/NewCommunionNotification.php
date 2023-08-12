<?php

namespace App\Notifications\DocumentRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestCommunion;

class NewCommunionNotification extends Notification
{
    use Queueable;

    private $documentRequestCommunion;

    public function __construct(DocumentRequestCommunion $documentRequestCommunion)
    {
        $this->documentRequestCommunion = $documentRequestCommunion;
    }

    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Communion Document Request for '. $this->documentRequestCommunion->name)
                ->greeting('Good day!')
                ->line('Communion Document Request for '. $this->documentRequestCommunion->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/documentrequestcommunions');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Communion Document Request for '. $this->documentRequestCommunion->name,
            'message' => 'Communion Document Request for '. $this->documentRequestCommunion->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/documentrequestcommunions'
        ];

    }
}
