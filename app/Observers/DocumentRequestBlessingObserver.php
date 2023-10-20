<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestBlessing;
use App\Models\Client;
use App\Models\User;
use App\Notifications\DocumentRequest\NewBlessingNotification;
use App\Notifications\DocumentRequestBlessingReadyNotification;
use App\Notifications\DocumentRequestBlessingRejectNotification;

class DocumentRequestBlessingObserver
{
    public function created(DocumentRequestBlessing $documentRequestBlessing) {
        

        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewBlessingNotification($documentRequestBlessing));
        }
    }

    public function setReady(DocumentRequestBlessing $documentRequestBlessing)
    {
        $client = Client::findOrFail($documentRequestBlessing->user_id);
        $client->notify(new DocumentRequestBlessingReadyNotification($documentRequestBlessing));
    }

    public function reject(DocumentRequestBlessing $documentRequestBlessing)
    {
        $client = Client::findOrFail($documentRequestBlessing->user_id);
        $client->notify(new DocumentRequestBlessingRejectNotification($documentRequestBlessing));
    }
}
