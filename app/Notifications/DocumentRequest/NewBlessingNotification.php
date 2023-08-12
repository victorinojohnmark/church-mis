<?php

namespace App\Notifications\DocumentRequest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\DocumentRequest\DocumentRequestBlessing;

class NewBlessingNotification extends Notification
{
    use Queueable;

    private $documentRequestBlessing;

    public function __construct(DocumentRequestBlessing $documentRequestBlessing)
    {
        $this->documentRequestBlessing = $documentRequestBlessing;
    }

    public function via(object $notifiable): array
    {
        return ['database','mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject('New Blessing Document Request for '. $this->documentRequestBlessing->name)
                ->greeting('Good day!')
                ->line('Blessing Document Request for '. $this->documentRequestBlessing->name .' was requested.')
                ->action('View reservations', env('APP_URL', 'localhost') . '/admin/documentrequestblessings');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New Blessing Document Request for '. $this->documentRequestBlessing->name,
            'message' => 'Blessing Document Request for '. $this->documentRequestBlessing->name .' was requested',
            'link' => env('APP_URL', 'localhost') . '/admin/documentrequestblessings'
        ];

    }
}
