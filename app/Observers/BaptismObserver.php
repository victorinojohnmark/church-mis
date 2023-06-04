<?php

namespace App\Observers;
use App\Models\Reservation\Baptism;
use App\Models\Client;
use App\Notifications\BaptismAcceptNotification;
use App\Notifications\BaptismRejectNotification;


class BaptismObserver
{
    public function reservationAccepted(Baptism $baptism)
    {
        //get client and notify
        $client = Client::findOrFail($baptism->created_by_id);
        $client->notify(new BaptismAcceptNotification($baptism));
    }

    public function reservationRejected(Baptism $baptism)
    {
        //get client and notify
        $client = Client::findOrFail($baptism->created_by_id);
        $client->notify(new BaptismRejectNotification($baptism));
    }
}
