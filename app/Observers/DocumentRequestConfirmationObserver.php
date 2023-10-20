<?php

namespace App\Observers;

use App\Models\DocumentRequest\DocumentRequestConfirmation;
use App\Models\Client;
use App\Models\User;
use App\Notifications\DocumentRequest\NewConfirmationNotification;
use App\Notifications\DocumentRequestConfirmationReadyNotification;
use App\Notifications\DocumentRequestConfirmationRejectNotification;


class DocumentRequestConfirmationObserver
{
    public function created(DocumentRequestConfirmation $documentRequestConfirmation) {
        

        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewConfirmationNotification($documentRequestConfirmation));
        }
    }

    public function setReady(DocumentRequestConfirmation $documentRequestConfirmation)
    {
        $client = Client::findOrFail($documentRequestConfirmation->user_id);
        $client->notify(new DocumentRequestConfirmationReadyNotification($documentRequestConfirmation));
    }

    public function reject(DocumentRequestConfirmation $documentRequestConfirmation)
    {
        $client = Client::findOrFail($documentRequestConfirmation->user_id);
        $client->notify(new DocumentRequestConfirmationRejectNotification($documentRequestConfirmation));
    }
}
