<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Matrimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Client;

class MatrimonyController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
       if(Auth::user()->is_admin){
            return view('admin.matrimony.matrimonylist', [
                'matrimonies' => Matrimony::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
       } else {
            return view('user.matrimony.matrimonylist', [
                'matrimonies' => Matrimony::where('created_by_id', Auth::id())->get(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
       }
    }

    public function show(Request $request, Matrimony $matrimony)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.matrimony.matrimonyview', [
            'matrimony' => $matrimony,
            'notificationCount' => $client->unreadNotifications->count()
        ]);
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.matrimony.matrimonycreate', [
            'matrimony' => new Matrimony(),
            'notificationCount' => $client->unreadNotifications->count()
        ]);
    }

    public function store(Request $request)
    {

        // Add custom validation rules
        Validator::extend('not_past_date', function ($attribute, $value, $parameters, $validator) {
            return Carbon::parse($value)->isToday() || Carbon::parse($value)->isFuture();
        });

        Validator::extend('day_of_week', function ($attribute, $value, $parameters, $validator) {
            $allowedDays = $parameters;
            $formattedDay = Carbon::parse($value)->format('D');
        
            return in_array($formattedDay, $allowedDays);
        });

        $data = $request->validate([
            'grooms_name' => ['required'],
            'grooms_birth_date' => ['required', 'date'],
            'brides_name' => ['required'],
            'brides_birth_date' => ['required', 'date'],
            'time' => ['required', 'in:07:30,09:00,10:30,16:00,07:30:00,09:00:00,10:30:00,16:00:00'],
            'wedding_date' => [
                'required',
                'date',
                'day_of_week:Tue,Wed,Thu,Fri,Sat',
                'not_past_date',
                Rule::unique('matrimonies')->ignore($request->id)
                    ->where(function ($query) use ($request) {
                        return $query->where('wedding_date', $request->wedding_date)
                            ->where('time', $request->time);
                    }),
            ],
            'relationship' => ['required', 'in:Mother,Father,Bride/Groom,Other'],
            'other_relationship' => ['required_if:relationship,Other'],
            'contact_number' => ['required', 'digits:11'],
            'created_by_id' => ['required']
        ], [
            'wedding_date.day_of_week' => 'The wedding date must be a Tuesday, Wednesday, Thursday, Friday, or Saturday.',
            'wedding_date.not_past_date' => 'The wedding date must be today or in the future.',
            'wedding_date.unique' => 'There is already a wedding scheduled for the selected date and time.',
            'time.in' => 'Invalid time selected.',
        ]);

        if($request->id) {

            //check first if date is already taken
            $isDateTaken = Matrimony::where('wedding_date', $data['wedding_date'])->where('time', $data['time'])->where('id','!=', $request->id)->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Wedding date submitted was already taken');
                return redirect()->back()->withInput();
            }

            $matrimony = Matrimony::findOrFail($request->id);
            $matrimony->fill($data);
            $matrimony->save();

            session()->flash('success', 'Matrimony Reservation updated successfully.');
        } else {

            //check first if date is already taken
            $isDateTaken = Matrimony::where('wedding_date', $data['wedding_date'])->where('time', $data['time'])->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Wedding date submitted was already taken');
                return redirect()->back()->withInput();
            }

            $matrimony = Matrimony::create($data);
            session()->flash('success', 'Matrimony Reservation created successfully.');
        }

        return redirect()->route('clientmatrimony');
    }

    public function acceptreservation(Request $request)
    {
        $matrimony = Matrimony::findOrFail($request->id);

        $matrimony->is_accepted = true;
        $matrimony->accepted_message = $request->accepted_message;
        $matrimony->save();

        $matrimony->triggerReservationAccepted();

        session()->flash('success', 'The matrimony reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $matrimony = Matrimony::findOrFail($request->id);

        $matrimony->is_rejected = true;
        $matrimony->rejection_message = $request->rejection_message;
        $matrimony->save();

        $matrimony->triggerReservationRejected();

        session()->flash('success', 'The matrimony reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function delete(Matrimony $matrimony) 
    {
        $matrimony->delete();
        session()->flash('success', 'Wedding reservation deleted successfully.');
        return redirect()->back();
    }
}
