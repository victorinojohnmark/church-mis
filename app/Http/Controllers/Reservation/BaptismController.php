<?php

namespace App\Http\Controllers\Reservation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\Reservation\Baptism;
use App\Models\Client;

use App\Rules\UniqueBaptismDateAndTime;

class BaptismController extends Controller
{

    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin){
            return view('admin.baptism.baptismlist', [
                'baptisms' => Baptism::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.baptism.baptismlist', [
                'baptisms' => Baptism::where('created_by_id', Auth::id())->get(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
        
        
    }

    public function show(Request $request, Baptism $baptism)
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(auth()->user()->id == $baptism->created_by_id) {
            return view('user.baptism.baptismview', [
                'baptism' => $baptism,
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        } else {
            abort(404);
        }
        
    }

    public function print(Request $request, Baptism $baptism)
    {
        return view('admin.baptism.baptismprint', [
            'baptism' => $baptism,
        ]);
        
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.baptism.baptismcreate', [
            'baptism' => new Baptism(),
            'notificationCount' => $client->unreadNotifications->count()
        ]);
        
    }

    public function store(Request $request)
    {
        $request->merge([
            'is_special' => $request->has('is_special') && $request->input('is_special') === 'on'
        ]);

        Validator::extend('special_date', function ($attribute, $value, $parameters, $validator) {
            // Check if is_special exists and is true
            $isSpecial = $validator->getData()['is_special'] ?? false;
        
            // Check if the date is not in the past
            $currentDate = date('Y-m-d');
            if (strtotime($value) < strtotime($currentDate)) {
                return false;
            }

            // Check if the date is not a Monday
            $dayOfWeek = date('N', strtotime($value));
            if ($dayOfWeek == 1) {
                return false;
            }
        
            if ($isSpecial) {
                // Check if the date is between Tuesday and Saturday
                $dayOfWeek = date('N', strtotime($value));
                if ($dayOfWeek >= 2 && $dayOfWeek <= 6) {
                    // Check if the time is between 8am and 5pm
                    $time = date('H:i', strtotime($validator->getData()['time']));
                    if ($time >= '08:00' && $time <= '17:00') {
                        return true;
                    }
                }
        
                return false;
            } else {
                // Check if the date is a Sunday and time is 10am
                $dayOfWeek = date('N', strtotime($value));
                $time = date('H:i', strtotime($validator->getData()['time']));
        
                return $dayOfWeek == 7 && $time == '10:00';
            }
        });

        // dd($request->all());

        $data = $request->validate([
            'name' => ['required'],
            'date' => ['required', 'date', 'special_date', new UniqueBaptismDateAndTime()],
            'time' => ['required'],
            'sex' => ['required', 'in:Male,Female'],
            'relationship' => ['required', 'in:Grandmother,Grandfather,Mother,Father,Sibling,Other'],
            'other_relationship' => ['required_if:relationship,Other'],
            'birth_date' => ['required', 'date'],
            'place_of_birth' => ['required'],
            'is_special' => ['sometimes', 'boolean'],
            'fathers_name' => ['required'],
            'mothers_name' => ['required'],
            'sponsor_1' => ['required'],
            'sponsor_2' => ['required'],
            'present_address' => ['required'],
            'contact_number' => ['required','digits:11'],
            'created_by_id' => ['required']
        ], [
            'date.special_date' => 'The selected date and time are not applicable.'
        ]);
        
        if($request->id) {
            
            //check first if date is already taken
            $isDateTaken = Baptism::where('date', $data['date'])->where('id','!=', $request->id)->exists();
            $isSpecial = $request->is_special ?? false;
            if($isSpecial && $isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back()->withInput();
            }

            $baptism = Baptism::findOrFail($request->id);
            $baptism->fill($data);
            $baptism->save();
            session()->flash('success', 'Baptism Reservation updated successfully.');
            
        } else {

            //check first if date is already taken
            $isDateTaken = Baptism::where('date', $data['date'])->exists();
            $isSpecial = $request->is_special ?? false;

            // dd($isSpecial && $isDateTaken);
            if($isSpecial && $isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back()->withInput();
            }

            $baptism = Baptism::Create($data);
            session()->flash('success', 'Baptism Reservation created successfully.');
        }

        return redirect()->route('clientbaptism');
    }

    public function acceptreservation(Request $request)
    {
        $baptism = Baptism::findOrFail($request->id);

        $baptism->is_accepted = true;
        $baptism->accepted_message = $request->accepted_message;
        $baptism->save();

        //trigger some events
        $baptism->triggerReservationAccepted();

        session()->flash('success', 'The baptism reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $baptism = Baptism::findOrFail($request->id);

        $baptism->is_rejected = true;
        $baptism->rejection_message = $request->rejection_message;
        $baptism->save();

        //trigger some events
        $baptism->triggerReservationRejected();

        session()->flash('warning', 'The baptism reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function delete(Baptism $baptism) 
    {
        $baptism->delete();
        session()->flash('success', 'Baptism reservation deleted successfully.');
        return redirect()->back();
    }
}
