<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestBaptism;
use App\Models\Client;
use App\Models\User;
use App\Notifications\DocumentRequest\NewBaptismNotification;
use App\Notifications\DocumentRequestBaptismReadyNotification;

class DocumentRequestBaptismObserver
{
    public function created(DocumentRequestBaptism $documentRequestBaptism) {
        

        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewBaptismNotification($documentRequestBaptism));
        }
    }

    public function setReady(DocumentRequestBaptism $documentRequestBaptism)
    {
        $client = Client::findOrFail($documentRequestBaptism->user_id);
        $client->notify(new DocumentRequestBaptismReadyNotification($documentRequestBaptism));
    }
}
