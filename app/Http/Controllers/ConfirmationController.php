<?php

namespace App\Http\Controllers;

use App\Models\Confirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmationController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.confirmation.confirmationlist', [
                'confirmations' => Confirmation::latest()->get()
            ]);
        } else {
            return view('user.confirmation.confirmationlist', [
                'confirmations' => Confirmation::where('created_by_id', Auth::id())->get()
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'date' => ['required', 'date'],
            'birth_date' => ['required', 'date'],
            'fathers_name' => ['required'],
            'mothers_name' => ['required'],
            'present_address' => ['required'],
            'contact_number' => ['required'],
            'created_by_id' => ['required']
        ]);

        if($request->id) {
            $confirmation = Confirmation::findOrFail($request->id);
            $confirmation->fill($data);
            $confirmation->save();

            session()->flash('success', 'Confirmation Reservation updated successfully.');
        } else {
            $confirmation = Confirmation::create($data);
            session()->flash('success', 'Confirmation Reservation created successfully.');
        }

        return redirect()->back();
    }

    public function acceptreservation(Request $request)
    {
        $confirmation = Confirmation::findOrFail($request->id);

        $confirmation->is_accepted = true;
        $confirmation->accepted_message = $request->accepted_message;
        $confirmation->save();

        //trigger some events
        //do someting

        session()->flash('success', 'The confirmation reservation has been accepted');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $confirmation = Confirmation::findOrFail($request->id);

        $confirmation->is_rejected = true;
        $confirmation->rejection_message = $request->rejection_message;
        $confirmation->save();

        //trigger some events
        //do someting

        session()->flash('warning', 'The confirmation reservation has been rejected');
        return redirect()->back();
    }
}
