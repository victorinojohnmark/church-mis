<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestDeath;
use App\Models\Client;
use App\Models\User;
use App\Notifications\DocumentRequestDeathReadyNotification;
use App\Notifications\DocumentRequest\NewDeathNotification;

class DocumentRequestDeathObserver
{
    public function created(DocumentRequestDeath $documentRequestDeath) {
        

        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewDeathNotification($documentRequestDeath));
        }
    }

    public function setReady(DocumentRequestDeath $documentRequestDeath)
    {
        $client = Client::findOrFail($documentRequestDeath->user_id);
        $client->notify(new DocumentRequestDeathReadyNotification($documentRequestDeath));
    }
}
