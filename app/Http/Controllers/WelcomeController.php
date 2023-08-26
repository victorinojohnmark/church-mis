<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Event;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'events' => Event::orderBy('start_date')->limit(6)->get()
        ]);
    }

    public function clientforgotpassword()
    {
        
    }

    public function clientresetpassword()
    {

    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}
