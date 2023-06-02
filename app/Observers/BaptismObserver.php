<?php

namespace App\Observers;
use App\Models\Baptism;
use App\Models\Client;
use App\Notifications\BaptismAcceptNotification;

class BaptismObserver
{
    public function reservationAccepted(Baptism $baptism)
    {
        //get client and notify
        $client = Client::findOrFail($baptism->created_by_id);
        $client->notify(new BaptismAcceptNotification($baptism));
    }
}
