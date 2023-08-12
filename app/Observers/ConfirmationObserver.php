<?php

namespace App\Observers;
use App\Models\Reservation\Confirmation;
use App\Models\Client;
use App\Models\User;
use App\Notifications\ConfirmationAcceptNotification;
use App\Notifications\ConfirmationRejectNotification;
use App\Notifications\Reservation\NewConfirmationNotification;


class ConfirmationObserver
{
    public function created(Confirmation $confirmation)
    {
        $admins = User::admin()->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewConfirmationNotification($confirmation));
        }
    }

    public function reservationAccepted(Confirmation $confirmation)
    {
        //get client and notify
        $client = Client::findOrFail($confirmation->created_by_id);
        $client->notify(new ConfirmationAcceptNotification($confirmation));
    }

    public function reservationRejected(Confirmation $confirmation)
    {
        //get client and notify
        $client = Client::findOrFail($confirmation->created_by_id);
        $client->notify(new ConfirmationRejectNotification($confirmation));
    }
    
}
