<?php

namespace App\Observers;
use App\Models\Reservation\Communion;
use App\Models\Client;
use App\Notifications\CommunionAcceptNotification;
use App\Notifications\CommunionRejectNotification;


class CommunionObserver
{
    public function reservationAccepted(Communion $communion)
    {
        //get client and notify
        $client = Client::findOrFail($communion->created_by_id);
        $client->notify(new CommunionAcceptNotification($communion));
    }

    public function reservationRejected(Communion $communion)
    {
        //get client and notify
        $client = Client::findOrFail($communion->created_by_id);
        $client->notify(new CommunionRejectNotification($communion));
    }
}
