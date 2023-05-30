<?php

namespace App\Http\Controllers;

use App\Models\Baptism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaptismController extends Controller
{

    public function index()
    {
        return view('user.baptism.baptismlist', [
            'baptisms' => Baptism::where('created_by_id', Auth::id())->get()
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
}
