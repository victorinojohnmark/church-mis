<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Funeral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FuneralController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.funeral.funerallist', [
                'funerals' => Funeral::latest()->get()
            ]);
        } else {
            return view('user.funeral.funerallist', [
                'funerals' => Funeral::where('created_by_id', Auth::id())->get()
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => ['required', 'date'], 
            'time' => ['required'], 
            'name' => ['required'], 
            'age' => ['required'], 
            'status' => ['required'], 
            'religion' => ['required'], 
            'address' => ['required'], 
            'date_of_death' => ['required', 'date'],
            'cause_of_death' => ['required'], 
            'cemetery' => ['required'], 
            'funeraria' => ['required'], 
            'contact_person' => ['required'], 
            'contact_number' => ['required'], 
            'created_by_id' => ['required'],
        ]);

        if($request->id) {
            $funeraria = Funeral::findOrFail($request->id);
            $funeraria->fill($data);
            $funeraria->save();

            session()->flash('success', 'Funeral Mass Reservation updated successfully.');
        } else {
            $funeraria = Funeral::Create($data);
            session()->flash('success', 'Funeral Mass Reservation created successfully.');
        }

        return redirect()->back();
    }

    public function acceptreservation(Request $request)
    {
        $funeral = Funeral::findOrFail($request->id);

        $funeral->is_accepted = true;
        $funeral->accepted_message = $request->accepted_message;
        $funeral->save();

        //trigger some events
        //do someting

        session()->flash('success', 'The funeral reservation has been accepted');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $funeral = Funeral::findOrFail($request->id);

        $funeral->is_rejected = true;
        $funeral->rejection_message = $request->rejection_message;
        $funeral->save();

        //trigger some events
        //do someting

        session()->flash('warning', 'The funeral reservation has been rejected');
        return redirect()->back();
    }
}
