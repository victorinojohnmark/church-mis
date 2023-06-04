<?php

namespace App\Observers;
use App\Models\Reservation\Confirmation;
use App\Models\Client;
use App\Notifications\ConfirmationAcceptNotification;
use App\Notifications\ConfirmationRejectNotification;


class ConfirmationObserver
{
    public function reservationAccepted(Confirmation $confirmation)
    {
        //get client and notify
        $client = Client::findOrFail($confirmation->created_by_id);
        $client->notify(new ConfirmationAcceptNotification($confirmation));
    }

    public function reservationRejected(Confirmation $confirmation)
    {
        //get client and notify
        $client = Client::findOrFail($confirmation->created_by_id);
        $client->notify(new ConfirmationRejectNotification($confirmation));
    }
    
}
