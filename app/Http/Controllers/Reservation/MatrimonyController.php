<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Matrimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function show(Request $request, Matrimony $matrimony)
    {
        return view('user.matrimony.matrimonyview', [
            'matrimony' => $matrimony
        ]);
    }

    public function create(Request $request)
    {
        return view('user.matrimony.matrimonycreate', [
            'matrimony' => new Matrimony()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->route('matrimony'));

        // Add custom validation rules
        Validator::extend('not_past_date', function ($attribute, $value, $parameters, $validator) {
            return Carbon::parse($value)->isToday() || Carbon::parse($value)->isFuture();
        });

        Validator::extend('day_of_week', function ($attribute, $value, $parameters, $validator) {
            $allowedDays = $parameters;
            $formattedDay = Carbon::parse($value)->format('D');
            // dd($formattedDay); // Debugging statement
        
            return in_array($formattedDay, $allowedDays);
        });

        $data = $request->validate([
            'grooms_name' => ['required'],
            'grooms_birth_date' => ['required', 'date'],
            'brides_name' => ['required'],
            'brides_birth_date' => ['required', 'date'],
            'wedding_date' => ['required', 'date', 'day_of_week:Tue,Wed,Thu,Fri,Sat', 'not_past_date', 
                                Rule::unique('matrimonies', 'wedding_date')->ignore($request->id)],
            'time' => ['required', 'in:07:30,09:00,10:30,16:00'],
            'contact_number' => ['required', 'digits:11'],
            'created_by_id' => ['required']
        ], [
            'wedding_date.day_of_week' => 'The wedding date must be a Tuesday, Wednesday, Thursday, Friday, or Saturday.',
            'wedding_date.not_past_date' => 'The wedding date must be today or in the future.',
            'wedding_date.unique' => 'There is already a wedding scheduled for the selected date.',
            'time.in' => 'Invalid time selected.',
        ]);

        if($request->id) {

            //check first if date is already taken
            $isDateTaken = Matrimony::where('wedding_date', $data['wedding_date'])->where('id','!=', $request->id)->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Wedding date submitted was already taken');
                return redirect()->back();
            }

            $matrimony = Matrimony::findOrFail($request->id);
            $matrimony->fill($data);
            $matrimony->save();

            session()->flash('success', 'Matrimony Reservation updated successfully.');
        } else {

            //check first if date is already taken
            $isDateTaken = Matrimony::where('wedding_date', $data['wedding_date'])->exists();
            if($isDateTaken) {
                session()->flash('danger', 'Wedding date submitted was already taken');
                return redirect()->back();
            }

            $matrimony = Matrimony::create($data);
            session()->flash('success', 'Matrimony Reservation created successfully.');
        }

        return redirect()->back();
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
}
