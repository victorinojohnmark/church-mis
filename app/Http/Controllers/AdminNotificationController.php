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
}
