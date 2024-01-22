<?php

namespace App\Notifications\DocumentRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestBaptism;

class NewBaptismNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $documentRequestBaptism;

    public function __construct(DocumentRequestBaptism $documentRequestBaptism)
    {
        $this->documentRequestBaptism = $documentRequestBaptism;
    }

    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Baptism Document Request for '. $this->documentRequestBaptism->name)
                ->greeting('Good day!')
                ->line('Baptism Document Request for '. $this->documentRequestBaptism->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/documentrequestbaptisms');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'document_request',
            'title' => 'New Baptism Document Request for '. $this->documentRequestBaptism->name,
            'message' => 'Baptism Document Request for '. $this->documentRequestBaptism->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/documentrequestbaptisms'
        ];

    }
}
