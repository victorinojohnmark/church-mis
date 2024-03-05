<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Blessing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

use App\Models\Client;

class BlessingController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin){
            return view('admin.blessing.blessinglist', [
                'blessings' => Blessing::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.blessing.blessinglist', [
                'blessings' => Blessing::where('created_by_id', Auth::id())->get(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
    }

    public function show(Request $request, Blessing $blessing)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.blessing.blessingview', [
            'blessing' => $blessing,
            'notificationCount' => $client->unreadNotifications->count()
        ]);
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.blessing.blessingcreate', [
            'blessing' => new Blessing(),
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
            'name' => ['required'], 
            'blessing_type' => ['required'], 
            'date' => ['required', 'date', 'after_or_equal:' . Date::today(), 'not_on_monday'], 
            'time' => ['required', 'time_range'],
            'address' => ['nullable'], 
            'landmark' => ['nullable'], 
            'contact_number' => ['required','digits:11'], 
            'created_by_id' => ['required']
        ], [
            'date.after_or_equal' => 'The date field should not be older that today.',
            'date.not_on_monday' => 'Date reservation for mondays is not valid.',
            'time.time_range' => 'Time reservation should be between 8:00am to 5:00pm.'
        ]);

        if($request->id) {
            //check first if date is already taken
            $isDateTaken = Blessing::where('date', $data['date'])->where('id','!=', $request->id)->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back()->withInput();
            }

            $blessing = Blessing::findOrFail($request->id);
            $blessing->fill($data);
            $blessing->save();

            session()->flash('success', 'Blessing Reservation updated successfully.');
        } else {
            //check first if date is already taken
            $isDateTaken = Blessing::where('date', $data['date'])->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back()->withInput();
            }

            $blessing = Blessing::Create($data);
            session()->flash('success', 'Blessing Reservation created successfully.');
        }

        return redirect()->back();
    }

    public function acceptreservation(Request $request)
    {
        $blessing = Blessing::findOrFail($request->id);

        $blessing->is_accepted = true;
        $blessing->accepted_message = $request->accepted_message;
        $blessing->save();

        $blessing->triggerReservationAccepted();

        session()->flash('success', 'The blessing reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $blessing = Blessing::findOrFail($request->id);

        $blessing->is_rejected = true;
        $blessing->rejection_message = $request->rejection_message;
        $blessing->save();

        $blessing->triggerReservationRejected();

        session()->flash('success', 'The blessing reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function delete(Blessing $blessing) 
    {
        $blessing->delete();
        session()->flash('success', 'Blessing reservation deleted successfully.');
        return redirect()->back();
    }
}
