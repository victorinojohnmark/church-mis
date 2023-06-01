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
}
