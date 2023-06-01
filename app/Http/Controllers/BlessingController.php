<?php

namespace App\Http\Controllers;

use App\Models\Blessing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'religion' => ['required'], 
            'address' => ['nullable'], 
            'landmark' => ['nullable'], 
            'contact_number' => ['required'], 
            'created_by_id' => ['required']
        ]);

        if($request->id) {
            $blessing = Blessing::findOrFail($request->id);
            $blessing->fill($data);
            $blessing->save();

            session()->flash('success', 'Blessing Reservation updated successfully.');
        } else {
            $blessing = Blessing::Create($data);
            session()->flash('success', 'Blessing Reservation created successfully.');
        }

        return redirect()->back();
    }
}
