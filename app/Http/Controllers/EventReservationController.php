<?php

namespace App\Http\Controllers;

use App\Models\EventReservation;
use Illuminate\Http\Request;

class EventReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'event' => ['required'],
            'event_date' => ['required', 'date']
        ]);

        $eventReservation = EventReservation::create($data);

        session()->flash('success', 'Event Reservation successfully submitted.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(EventReservation $eventReservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventReservation $eventReservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventReservation $eventReservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventReservation $eventReservation)
    {
        //
    }
}
