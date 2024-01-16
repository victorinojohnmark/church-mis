<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\EventReservation;

use App\Models\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.client.clientlist', [
            'clients' => User::client()->orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Client $client)
    {
        //
    }

    public function update(Request $request, Client $client)
    {
        //
    }

    public function reservation()
    {
        $client = Client::findOrFail(auth()->user()->id);
        $eventReservations = EventReservation::where('user_id', Auth::id())->get();

        return view('user.eventreservation', [
            'eventReservations' => $eventReservations,
            'notificationCount' => $client->unreadNotifications->count()
        ]);
    }
}
