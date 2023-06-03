<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestMatrimony;
use App\Models\Client;
use App\Notifications\DocumentRequestMatrimonyReadyNotification;

class DocumentRequestMatrimonyObserver
{
    public function setReady(DocumentRequestMatrimony $documentRequestMatrimony)
    {
        $client = Client::findOrFail($documentRequestMatrimony->user_id);
        $client->notify(new DocumentRequestMatrimonyReadyNotification($documentRequestMatrimony));
    }
}
