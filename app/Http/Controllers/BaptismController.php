<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Baptism;

class BaptismController extends Controller
{

    public function index()
    {
        if(Auth::user()->is_admin){
            return view('admin.baptism.baptismlist', [
                'baptisms' => Baptism::latest()->get()
            ]);
        } else {
            return view('user.baptism.baptismlist', [
                'baptisms' => Baptism::where('created_by_id', Auth::id())->get()
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
            $baptism = Baptism::findOrFail($request->id);
            $baptism->fill($data);
            $baptism->save();

            session()->flash('success', 'Baptism Reservation updated successfully.');
        } else {
            $baptism = Baptism::Create($data);
            session()->flash('success', 'Baptism Reservation created successfully.');
        }

        return redirect()->back();
    }

    public function acceptreservation(Request $request)
    {
        $baptism = Baptism::findOrFail($request->id);

        $baptism->is_accepted = true;
        $baptism->accepted_message = $request->accepted_message;
        $baptism->save();

        //trigger some events
        $baptism->triggerReservationAccepted();

        session()->flash('success', 'The baptism reservation has been accepted');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $baptism = Baptism::findOrFail($request->id);

        $baptism->is_rejected = true;
        $baptism->rejection_message = $request->rejection_message;
        $baptism->save();

        //trigger some events
        //do someting

        session()->flash('warning', 'The baptism reservation has been rejected');
        return redirect()->back();
    }
}
