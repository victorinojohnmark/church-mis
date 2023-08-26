<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Matrimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class MatrimonyController extends Controller
{
    public function index()
    {
       if(Auth::user()->is_admin){
            return view('admin.matrimony.matrimonylist', [
                'matrimonies' => Matrimony::latest()->get()
            ]);
       } else {
            return view('user.matrimony.matrimonylist', [
                'matrimonies' => Matrimony::where('created_by_id', Auth::id())->get()
            ]);
       }
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'grooms_name' => ['required'],
            'grooms_birth_date' => ['required', 'date'],
            'brides_name' => ['required'],
            'brides_birth_date' => ['required', 'date'],
            'wedding_date' => ['required', 'date'],
            'contact_number' => ['required','digits:11'],
            'created_by_id' => ['required']
        ]);

        if($request->id) {

            //check first if date is already taken
            $isDateTaken = Matrimony::where('wedding_date', $data['wedding_date'])->where('id','!=', $request->id)->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Wedding date submitted was already taken');
                return redirect()->back();
            }

            $matrimony = Matrimony::findOrFail($request->id);
            $matrimony->fill($data);
            $matrimony->save();

            session()->flash('success', 'Matrimony Reservation updated successfully.');
        } else {

            //check first if date is already taken
            $isDateTaken = Matrimony::where('wedding_date', $data['wedding_date'])->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Wedding date submitted was already taken');
                return redirect()->back();
            }

            $matrimony = Matrimony::create($data);
            session()->flash('success', 'Matrimony Reservation created successfully.');
        }

        return redirect()->back();
    }

    public function acceptreservation(Request $request)
    {
        $matrimony = Matrimony::findOrFail($request->id);

        $matrimony->is_accepted = true;
        $matrimony->accepted_message = $request->accepted_message;
        $matrimony->save();

        $matrimony->triggerReservationAccepted();

        session()->flash('success', 'The matrimony reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $matrimony = Matrimony::findOrFail($request->id);

        $matrimony->is_rejected = true;
        $matrimony->rejection_message = $request->rejection_message;
        $matrimony->save();

        $matrimony->triggerReservationRejected();

        session()->flash('success', 'The matrimony reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }
}
