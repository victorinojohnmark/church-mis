<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Client;

class EventReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin) {
            return view('admin.reservation.reservationlist', [
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.eventreservation', [
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
        
    }
}
