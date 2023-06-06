<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.event.eventlist', [
            'events' => Event::latest()->get()
        ]);
    }
}
