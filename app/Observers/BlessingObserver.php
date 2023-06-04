<?php

namespace App\Observers;
use App\Models\Reservation\Blessing;
use App\Models\Client;
use App\Notifications\BlessingAcceptNotification;

class BlessingObserver
{
    public function reservationAccepted(Blessing $blessing)
    {
        //get client and notify
        $client = Client::findOrFail($blessing->created_by_id);
        $client->notify(new BlessingAcceptNotification($blessing));
    }
}
