<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestDeath;
use App\Models\Client;
use App\Notifications\DocumentRequestDeathReadyNotification;

class DocumentRequestDeathObserver
{
    public function setReady(DocumentRequestDeath $documentRequestDeath)
    {
        $client = Client::findOrFail($documentRequestDeath->user_id);
        $client->notify(new DocumentRequestDeathReadyNotification($documentRequestDeath));
    }
}
