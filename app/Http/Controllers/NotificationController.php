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

    public function getEventNotificationCount($event_type)
    {
        $client = Client::findOrFail(Auth::id());
        // Fetch the count of notifications based on the event_type
        $notificationCount = $client->notifications()
            ->whereJsonContains('data->type', $event_type)
            ->count();

        return response()->json(['count' => $notificationCount]);
    }

    public function getEventNotification($event_type)
    {
        $client = Client::findOrFail(Auth::id());
        // Fetch notification records based on the event_type
        $notifications = $client->notifications()
            ->whereJsonContains('data->type', $event_type)
            ->get();

        return view('user.notificationlist', [
            'notifications' => $notifications,
        ]);
    }
}
