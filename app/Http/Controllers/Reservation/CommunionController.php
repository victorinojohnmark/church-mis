<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Communion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommunionController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.communion.communionlist', [
                'communions' => Communion::latest()->get()
            ]);
        } else {
            return view('user.communion.communionlist', [
                'communions' => Communion::where('created_by_id', Auth::id())->get()
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
            $communion = Communion::findOrFail($request->id);
            $communion->fill($data);
            $communion->save();

            session()->flash('success', 'Communion Reservation updated successfully.');
        } else {
            $communion = Communion::create($data);
            session()->flash('success', 'Communion Reservation created successfully.');
        }

        return redirect()->back();
    }

    public function acceptreservation(Request $request)
    {
        $communion = Communion::findOrFail($request->id);

        $communion->is_accepted = true;
        $communion->accepted_message = $request->accepted_message;
        $communion->save();

        //trigger some events
        //do someting

        session()->flash('success', 'The communion reservation has been accepted');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $communion = Communion::findOrFail($request->id);

        $communion->is_rejected = true;
        $communion->rejection_message = $request->rejection_message;
        $communion->save();

        //trigger some events
        //do someting

        session()->flash('warning', 'The communion reservation has been rejected');
        return redirect()->back();
    }
}
