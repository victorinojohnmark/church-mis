<?php

namespace App\Observers;
use App\Models\Reservation\Matrimony;
use App\Models\Client;
use App\Models\User;
use App\Notifications\MatrimonyAcceptNotification;
use App\Notifications\MatrimonyRejectNotification;
use App\Notifications\Reservation\NewMatrimonyNotification;

class MatrimonyObserver
{
    public function created(Matrimony $matrimony)
    {
        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewMatrimonyNotification($matrimony));
        }
    }

    public function reservationAccepted(Matrimony $matrimony)
    {
        //get client and notify
        $client = Client::findOrFail($matrimony->created_by_id);
        $client->notify(new MatrimonyAcceptNotification($matrimony));
    }

    public function reservationRejected(Matrimony $matrimony)
    {
        //get client and notify
        $client = Client::findOrFail($matrimony->created_by_id);
        $client->notify(new MatrimonyRejectNotification($matrimony));
    }
}
