<?php

namespace App\Observers;
use App\Models\Reservation\Matrimony;
use App\Models\Client;
use App\Notifications\MatrimonyAcceptNotification;

class MatrimonyObserver
{
    public function reservationAccepted(Matrimony $matrimony)
    {
        //get client and notify
        $client = Client::findOrFail($matrimony->created_by_id);
        $client->notify(new MatrimonyAcceptNotification($matrimony));
    }
}
