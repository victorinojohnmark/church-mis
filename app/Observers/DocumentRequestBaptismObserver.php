<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestBaptism;
use App\Models\Client;
use App\Notifications\DocumentRequestBaptismReadyNotification;

class DocumentRequestBaptismObserver
{
    public function setReady(DocumentRequestBaptism $documentRequestBaptism)
    {
        $client = Client::findOrFail($documentRequestBaptism->user_id);
        $client->notify(new DocumentRequestBaptismReadyNotification($documentRequestBaptism));
    }
}
