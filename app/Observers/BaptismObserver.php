<?php

namespace App\Observers;
use App\Models\Reservation\Baptism;
use App\Models\Client;
use App\Models\User;
use App\Notifications\BaptismAcceptNotification;
use App\Notifications\BaptismRejectNotification;
use App\Notifications\Reservation\NewBaptismNotification;

class BaptismObserver
{
    public function created(Baptism $baptism) {
        

        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewBaptismNotification($baptism));
        }
    }

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
