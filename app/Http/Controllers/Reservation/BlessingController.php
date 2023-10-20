<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Blessing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BlessingController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin){
            return view('admin.blessing.blessinglist', [
                'blessings' => Blessing::latest()->get()
            ]);
        } else {
            return view('user.blessing.blessinglist', [
                'blessings' => Blessing::where('created_by_id', Auth::id())->get()
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'], 
            'blessing_type' => ['required'], 
            'date' => ['required', 'date'], 
            'time' => ['required'], 
            // 'religion' => ['required'], 
            'address' => ['nullable'], 
            'landmark' => ['nullable'], 
            'contact_number' => ['required','digits:11'], 
            'created_by_id' => ['required']
        ]);

        if($request->id) {
            //check first if date is already taken
            $isDateTaken = Blessing::where('date', $data['date'])->where('id','!=', $request->id)->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back();
            }

            $blessing = Blessing::findOrFail($request->id);
            $blessing->fill($data);
            $blessing->save();

            session()->flash('success', 'Blessing Reservation updated successfully.');
        } else {
            //check first if date is already taken
            $isDateTaken = Blessing::where('date', $data['date'])->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back();
            }

            $blessing = Blessing::Create($data);
            session()->flash('success', 'Blessing Reservation created successfully.');
        }

        return redirect()->back();
    }

    public function acceptreservation(Request $request)
    {
        $blessing = Blessing::findOrFail($request->id);

        $blessing->is_accepted = true;
        $blessing->accepted_message = $request->accepted_message;
        $blessing->save();

        $blessing->triggerReservationAccepted();

        session()->flash('success', 'The blessing reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $blessing = Blessing::findOrFail($request->id);

        $blessing->is_rejected = true;
        $blessing->rejection_message = $request->rejection_message;
        $blessing->save();

        $blessing->triggerReservationRejected();

        session()->flash('success', 'The blessing reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }
}
