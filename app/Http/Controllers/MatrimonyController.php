<?php

namespace App\Http\Controllers;

use App\Models\Matrimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'contact_number' => ['required'],
            'created_by_id' => ['required']
        ]);

        if($request->id) {
            $matrimony = Matrimony::findOrFail($request->id);
            $matrimony->fill($data);
            $matrimony->save();

            session()->flash('success', 'Matrimony Reservation updated successfully.');
        } else {
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

        //trigger some events
        //do someting

        session()->flash('success', 'The matrimony reservation has been accepted');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $matrimony = Matrimony::findOrFail($request->id);

        $matrimony->is_rejected = true;
        $matrimony->rejection_message = $request->rejection_message;
        $matrimony->save();

        //trigger some events
        //do someting

        session()->flash('warning', 'The matrimony reservation has been rejected');
        return redirect()->back();
    }
}
