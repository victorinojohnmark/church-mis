<?php

namespace App\Observers;
use App\Models\Reservation\Funeral;
use App\Models\Client;
use App\Notifications\FuneralAcceptNotification;

class FuneralObserver
{
    public function reservationAccepted(Funeral $funeral)
    {
        //get client and notify
        $client = Client::findOrFail($funeral->created_by_id);
        $client->notify(new FuneralAcceptNotification($funeral));
    }
}
