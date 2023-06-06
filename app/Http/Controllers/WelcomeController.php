<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'events' => Event::latest()->limit(3)->get()
        ]);
    }
}
