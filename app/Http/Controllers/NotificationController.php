<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(Auth::id());
        return view('user.notificationlist', [
            'notifications' => $client->unreadNotifications,
        ]);
    }

    public function destroy($notification)
    {
        $client = Client::findOrFail(Auth::id());
        $notification = $client->notifications()->find($notification);

        // Check if the notification exists
        if ($notification) {
            // Mark the notification as read
            $notification->markAsRead();

            // Additional logic if needed

            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Notification not found.');
        }
    }
}
