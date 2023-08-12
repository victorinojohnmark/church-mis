<?php

namespace App\Notifications\DocumentRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\DocumentRequest\DocumentRequestMatrimony;

class NewMatrimonyNotification extends Notification
{
    use Queueable;

    private $documentRequestMatrimony;

    public function __construct(DocumentRequestMatrimony $documentRequestMatrimony)
    {
        $this->documentRequestMatrimony = $documentRequestMatrimony;
    }

    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Matrimony Document Request for '. $this->documentRequestMatrimony->name)
                ->greeting('Good day!')
                ->line('Matrimony Document Request for '. $this->documentRequestMatrimony->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/documentrequestmatrimonies');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Matrimony Document Request for '. $this->documentRequestMatrimony->name,
            'message' => 'Matrimony Document Request for '. $this->documentRequestMatrimony->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/documentrequestmatrimonies'
        ];

    }
}
