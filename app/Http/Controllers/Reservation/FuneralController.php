<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Funeral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Client;
class FuneralController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin) {
            return view('admin.funeral.funerallist', [
                'funerals' => Funeral::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.funeral.funerallist', [
                'funerals' => Funeral::where('created_by_id', Auth::id())->get(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
    }

    public function show(Request $request, Funeral $funeral)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.funeral.funeralview', [
            'funeral' => $funeral,
            'notificationCount' => $client->unreadNotifications->count()
        ]);
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.funeral.funeralcreate', [
            'funeral' => new Funeral(),
            'notificationCount' => $client->unreadNotifications->count()
        ]);
    }

    public function store(Request $request)
    {
        Validator::extend('not_on_monday', function ($attribute, $value, $parameters, $validator) {
            return Date::parse($value)->dayOfWeek !== 1; // 1 represents Monday
        });

        Validator::extend('time_range', function ($attribute, $value, $parameters, $validator) {
            $startTime = strtotime('08:00');
            $endTime = strtotime('17:00');
            $selectedTimestamp = strtotime($value);
        
            return $selectedTimestamp >= $startTime && $selectedTimestamp <= $endTime;
        });

        $data = $request->validate([
            'date' => ['required', 'date', 'after_or_equal:' . Date::today(), 'not_on_monday',
                        Rule::unique('funerals', 'date')->ignore($request->id)], 
            'time' => ['required', 'time_range'], 
            'name' => ['required'], 
            'age' => ['required'], 
            'sex' => ['required', 'in:Male,Female'],
            'relationship' => ['required', 'in:Grandmother,Grandfather,Mother,Father,Sibling'],
            'status' => ['required'], 
            // 'religion' => ['required'], 
            'address' => ['required'], 
            'date_of_death' => ['required', 'date'],
            'cause_of_death' => ['required'], 
            'cemetery' => ['required'], 
            'funeraria' => ['required'], 
            'contact_person' => ['required'], 
            'contact_number' => ['required','digits:11'], 
            'created_by_id' => ['required'],
        ], [
            'date.after_or_equal' => 'The date field should not be older that today.',
            'date.not_on_monday' => 'Date reservation for mondays is not valid.',
            'time.time_range' => 'Time reservation should be between 8:00am to 5:00pm.'
        ]);

        if($request->id) {
            //check first if date is already taken
            // $isDateTaken = Funeral::where('date', $data['date'])->where('id','!=', $request->id)->exists();
            // if($isDateTaken) {
            //     session()->flash('danger', 'Date submitted was already taken');
            //     return redirect()->back();
            // }

            $funeraria = Funeral::findOrFail($request->id);
            $funeraria->fill($data);
            $funeraria->save();

            session()->flash('success', 'Funeral Mass Reservation updated successfully.');
        } else {

            //check first if date is already taken
            // $isDateTaken = Funeral::where('date', $data['date'])->exists();
            // if($isDateTaken) {
            //     session()->flash('danger', 'Date submitted was already taken');
            //     return redirect()->back();
            // }

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

        $funeral->triggerReservationAccepted();

        session()->flash('success', 'The funeral reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $funeral = Funeral::findOrFail($request->id);

        $funeral->is_rejected = true;
        $funeral->rejection_message = $request->rejection_message;
        $funeral->save();

        $funeral->triggerReservationRejected();

        session()->flash('success', 'The funeral reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }
}
