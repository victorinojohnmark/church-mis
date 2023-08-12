<?php

namespace App\Observers;
use App\Models\Reservation\Blessing;
use App\Models\Client;
use App\Models\User;
use App\Notifications\BlessingAcceptNotification;
use App\Notifications\BlessingRejectNotification;
use App\Notifications\Reservation\NewBlessingNotification;

class BlessingObserver
{
    public function created(Blessing $blessing)
    {
        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewBlessingNotification($blessing));
        }
    }

    public function reservationAccepted(Blessing $blessing)
    {
        //get client and notify
        $client = Client::findOrFail($blessing->created_by_id);
        $client->notify(new BlessingAcceptNotification($blessing));
    }

    public function reservationRejected(Blessing $blessing)
    {
        //get client and notify
        $client = Client::findOrFail($blessing->created_by_id);
        $client->notify(new BlessingRejectNotification($blessing));
    }
}
