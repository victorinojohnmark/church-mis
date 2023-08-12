<?php

namespace App\Observers;
use App\Models\Reservation\Funeral;
use App\Models\Client;
use App\Notifications\FuneralAcceptNotification;
use App\Notifications\FuneralRejectNotification;
use App\Models\User;
use App\Notifications\Reservation\NewFuneralNotification;

class FuneralObserver
{
    public function created(Funeral $funeral)
    {
        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewFuneralNotification($funeral));
        }
    }

    public function reservationAccepted(Funeral $funeral)
    {
        //get client and notify
        $client = Client::findOrFail($funeral->created_by_id);
        $client->notify(new FuneralAcceptNotification($funeral));
    }

    public function reservationRejected(Funeral $funeral)
    {
        //get client and notify
        $client = Client::findOrFail($funeral->created_by_id);
        $client->notify(new FuneralRejectNotification($funeral));
    }
}
