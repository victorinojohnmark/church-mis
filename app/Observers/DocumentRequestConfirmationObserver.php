<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestConfirmation;
use App\Models\Client;
use App\Notifications\DocumentRequestConfirmationReadyNotification;

class DocumentRequestConfirmationObserver
{
    public function setReady(DocumentRequestConfirmation $documentRequestConfirmation)
    {
        $client = Client::findOrFail($documentRequestConfirmation->user_id);
        $client->notify(new DocumentRequestConfirmationReadyNotification($documentRequestConfirmation));
    }
}
