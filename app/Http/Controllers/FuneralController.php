<?php

namespace App\Http\Controllers;

use App\Models\Funeral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
