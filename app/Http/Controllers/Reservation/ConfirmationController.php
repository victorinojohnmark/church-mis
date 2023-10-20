<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Confirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

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
            'contact_number' => ['required', 'digits:11'],
            'created_by_id' => ['required']
        ]);

        if($request->id) {

            //check first if date is already taken
            $isDateTaken = Confirmation::where('date', $data['date'])->where('id','!=', $request->id)->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back();
            }

            $confirmation = Confirmation::findOrFail($request->id);
            $confirmation->fill($data);
            $confirmation->save();

            session()->flash('success', 'Confirmation Reservation updated successfully.');
        } else {

            //check first if date is already taken
            $isDateTaken = Confirmation::where('date', $data['date'])->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back();
            }

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

        $confirmation->triggerReservationAccepted();

        session()->flash('success', 'The confirmation reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $confirmation = Confirmation::findOrFail($request->id);

        $confirmation->is_rejected = true;
        $confirmation->rejection_message = $request->rejection_message;
        $confirmation->save();

        $confirmation->triggerReservationRejected();

        session()->flash('success', 'The confirmation reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }
}
