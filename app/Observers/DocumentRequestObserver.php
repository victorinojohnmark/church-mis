<?php

namespace App\Observers;

use App\Models\DocumentRequest;
use App\Models\Client;
use App\Notifications\DocumentRequestReadyNotification;

class DocumentRequestObserver
{
    /**
     * Handle the DocumentRequest "created" event.
     */
    public function created(DocumentRequest $documentRequest): void
    {
        $documentRequest->request_code = now()->format('y') . now()->format('m') . str_pad($documentRequest->id, 6, '0', STR_PAD_LEFT);
        $documentRequest->update();
    }

    public function setReady(DocumentRequest $documentRequest)
    {
        $client = Client::findOrFail($documentRequest->user_id);
        $client->notify(new DocumentRequestReadyNotification($documentRequest));
    }
}
