<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestBlessing;
use App\Models\Client;
use App\Notifications\DocumentRequestBlessingReadyNotification;

class DocumentRequestBlessingObserver
{
    public function setReady(DocumentRequestBlessing $documentRequestBlessing)
    {
        $client = Client::findOrFail($documentRequestBlessing->user_id);
        $client->notify(new DocumentRequestBlessingReadyNotification($documentRequestBlessing));
    }
}
