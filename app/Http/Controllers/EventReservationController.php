<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.reservation.reservationlist');
        } else {
            return view('user.eventreservation');
        }
        
    }
}
