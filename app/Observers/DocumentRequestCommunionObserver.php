<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestCommunion;
use App\Models\Client;
use App\Notifications\DocumentRequestCommunionReadyNotification;

class DocumentRequestCommunionObserver
{
    public function setReady(DocumentRequestCommunion $documentRequestCommunion)
    {
        $client = Client::findOrFail($documentRequestCommunion->user_id);
        $client->notify(new DocumentRequestCommunionReadyNotification($documentRequestCommunion));
    }
}
