<?php

namespace App\Observers;
use App\Models\Reservation\Baptism;
use App\Models\Client;
use App\Models\User;
use App\Notifications\BaptismAcceptNotification;
use App\Notifications\BaptismRejectNotification;
use App\Notifications\NewReservationNotification;


class BaptismObserver
{
    public function created(Baptism $baptism) {
        

        $admins = User::where('is_admin', false)->get();

        foreach ($admins as $admin) {
            $detail = [
                'user' => $baptism->createdBy->name,
                'admin' => $admin->name,
                'transaction' => 'Baptism',
                'date' => $baptism->date,
                'url' => '/admin/baptisms'
            ];

            $admin->notify(new NewReservationNotification($detail));
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
