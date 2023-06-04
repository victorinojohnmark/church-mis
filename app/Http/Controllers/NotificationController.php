<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

class NotificationController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(Auth::id());
        return view('user.notificationlist', [
            'notifications' => $client->notifications
        ]);
    }
}
