<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
    public function index() {
        return view('admin.notificationlist', [
            'notifications' => Auth::user()->notifications
        ]);
    }

    public function destroy($notification)
    {
        $notification = auth()->user()->notifications()->find($notification);

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

        // Fetch the count of notifications based on the event_type
        $notificationCount = auth()->user()->unreadNotifications()
            ->whereJsonContains('data->type', $event_type)
            ->count();

        return response()->json(['count' => $notificationCount]);
    }

    public function getEventNotification($event_type)
    {

        // Fetch notification records based on the event_type
        $notifications = auth()->user()->unreadNotifications()
            ->whereJsonContains('data->type', $event_type)
            ->get();

        return view('admin.notificationlist', [
            'notifications' => $notifications,
        ]);
    }
}
