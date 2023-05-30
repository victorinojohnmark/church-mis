<?php

namespace App\Http\Controllers;

use App\Models\Communion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunionController extends Controller
{
    public function index()
    {
        return view('user.communion.communionlist', [
            'communions' => Communion::where('created_by_id', Auth::id())->get()
        ]);
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
}
