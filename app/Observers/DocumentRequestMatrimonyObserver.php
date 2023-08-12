<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestMatrimony;
use App\Models\Client;
use App\Models\User;
use App\Notifications\DocumentRequestMatrimonyReadyNotification;
use App\Notifications\DocumentRequest\NewMatrimonyNotification;

class DocumentRequestMatrimonyObserver
{
    public function created(DocumentRequestMatrimony $documentRequestMatrimony) {
        

        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewMatrimonyNotification($documentRequestMatrimony));
        }
    }

    public function setReady(DocumentRequestMatrimony $documentRequestMatrimony)
    {
        $client = Client::findOrFail($documentRequestMatrimony->user_id);
        $client->notify(new DocumentRequestMatrimonyReadyNotification($documentRequestMatrimony));
    }
}
