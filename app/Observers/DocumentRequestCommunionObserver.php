<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestCommunion;
use App\Models\Client;
use App\Models\User;
use App\Notifications\DocumentRequest\NewCommunionNotification;
use App\Notifications\DocumentRequestCommunionReadyNotification;
use App\Notifications\DocumentRequestCommunionRejectNotification;

class DocumentRequestCommunionObserver
{
    public function created(DocumentRequestCommunion $documentRequestCommunion) {
        

        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewCommunionNotification($documentRequestCommunion));
        }
    }

    public function setReady(DocumentRequestCommunion $documentRequestCommunion)
    {
        $client = Client::findOrFail($documentRequestCommunion->user_id);
        $client->notify(new DocumentRequestCommunionReadyNotification($documentRequestCommunion));
    }

    public function reject(DocumentRequestCommunion $documentRequestCommunion)
    {
        $client = Client::findOrFail($documentRequestCommunion->user_id);
        $client->notify(new DocumentRequestCommunionRejectNotification($documentRequestCommunion));
    }
}
