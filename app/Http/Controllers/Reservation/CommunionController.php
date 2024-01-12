<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Communion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class CommunionController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.communion.communionlist', [
                'communions' => Communion::latest()->get()
            ]);
        } else {
            return view('user.communion.communionlist', [
                'communions' => Communion::where('created_by_id', Auth::id())->get()
            ]);
        }
    }

    public function show(Request $request, Communion $communion)
    {
        return view('user.communion.communionview', [
            'communion' => $communion
        ]);
    }

    public function create(Request $request)
    {
        return view('user.communion.communioncreate', [
            'commmunion' => new Communion()
        ]);
    }

    public function store(Request $request)
    {
        Validator::extend('not_on_monday', function ($attribute, $value, $parameters, $validator) {
            return Date::parse($value)->dayOfWeek !== 1; // 1 represents Monday
        });

        $data = $request->validate([
            'name' => ['required'],
            'date' => ['required', 'date', 'after_or_equal:' . Date::today(), 'not_on_monday'],
            'birth_date' => ['required', 'date'],
            'fathers_name' => ['required'],
            'mothers_name' => ['required'],
            'present_address' => ['required'],
            'contact_number' => ['required','digits:11'],
            'created_by_id' => ['required']
        ], [
            'date.after_or_equal' => 'The date field should not be older that today.',
            'date.not_on_monday' => 'Date reservation for mondays is not valid.'
        ]);

        if($request->id) {
            //check first if date is already taken
            $isDateTaken = Communion::where('date', $data['date'])->where('id','!=', $request->id)->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back();
            }

            $communion = Communion::findOrFail($request->id);
            $communion->fill($data);
            $communion->save();

            session()->flash('success', 'Communion Reservation updated successfully.');
        } else {
            //check first if date is already taken
            $isDateTaken = Communion::where('date', $data['date'])->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Date submitted was already taken');
                return redirect()->back();
            }

            $communion = Communion::create($data);
            session()->flash('success', 'Communion Reservation created successfully.');
        }

        return redirect()->back();
    }

    public function acceptreservation(Request $request)
    {
        $communion = Communion::findOrFail($request->id);

        $communion->is_accepted = true;
        $communion->accepted_message = $request->accepted_message;
        $communion->save();

        $communion->triggerReservationAccepted();

        session()->flash('success', 'The communion reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $communion = Communion::findOrFail($request->id);

        $communion->is_rejected = true;
        $communion->rejection_message = $request->rejection_message;
        $communion->save();

        $communion->triggerReservationRejected();

        session()->flash('success', 'The communion reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }
}
