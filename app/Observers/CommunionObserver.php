<?php

namespace App\Observers;
use App\Models\Reservation\Communion;
use App\Models\Client;
use App\Notifications\CommunionAcceptNotification;
use App\Notifications\CommunionRejectNotification;
use App\Notifications\Reservation\NewCommunionNotification;
use App\Models\User;

class CommunionObserver
{
    public function created(Communion $communion)
    {
        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewCommunionNotification($communion));
        }
    }

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
