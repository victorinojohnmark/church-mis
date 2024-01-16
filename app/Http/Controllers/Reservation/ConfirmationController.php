<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Confirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class ConfirmationController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.confirmation.confirmationlist', [
                'confirmations' => Confirmation::latest()->get()
            ]);
        } else {
            return view('user.confirmation.confirmationlist', [
                'confirmations' => Confirmation::where('created_by_id', Auth::id())->get()
            ]);
        }
    }

    public function show(Request $request, Confirmation $confirmation)
    {
        return view('user.confirmation.confirmationview', [
            'confirmation' => $confirmation
        ]);
    }

    public function create(Request $request)
    {
        return view('user.confirmation.confirmationcreate', [
            'confirmation' => new Confirmation()
        ]);
    }

    public function store(Request $request)
    {
        Validator::extend('not_on_monday', function ($attribute, $value, $parameters, $validator) {
            return Date::parse($value)->dayOfWeek !== 1; // 1 represents Monday
        });

        $data = $request->validate([
            'name' => ['required'],
            // 'date' => ['required', 'date', 'after_or_equal:' . Date::today(), 'not_on_monday'],
            // 'birth_date' => ['required', 'date'],
            // 'fathers_name' => ['required'],
            // 'mothers_name' => ['required'],
            'present_address' => ['required'],
            'contact_number' => ['required', 'digits:11'],
            'created_by_id' => ['required'],
            'file' => 'required|mimes:xls,xlsx,csv'
        ], [
            'date.after_or_equal' => 'The date field should not be older that today.',
            'date.not_on_monday' => 'Date reservation for mondays is not valid.'
        ]);

        if($request->id) {

            //check first if date is already taken
            // $isDateTaken = Confirmation::where('date', $data['date'])->where('id','!=', $request->id)->exists();
            // if($isDateTaken) {
            //     session()->flash('danger', 'Date submitted was already taken');
            //     return redirect()->back();
            // }

            $confirmation = Confirmation::findOrFail($request->id);
            $confirmation->fill($data);

            if($request->hasFile('file')) {
                $uniqueFilename = uniqid() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $uniqueFilename, 'public');
                $confirmation->file = $filePath;
            }

            $confirmation->save();

            session()->flash('success', 'Confirmation Reservation updated successfully.');
        } else {

            //check first if date is already taken
            // $isDateTaken = Confirmation::where('date', $data['date'])->exists();
            // if($isDateTaken) {
            //     session()->flash('danger', 'Date submitted was already taken');
            //     return redirect()->back();
            // }

            if($request->hasFile('file')) {
                $uniqueFilename = uniqid() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $uniqueFilename, 'public');
                $data['file'] = $filePath;
            }

            $confirmation = Confirmation::create($data);
            session()->flash('success', 'Confirmation Reservation created successfully.');
        }

        return redirect()->route('clientconfirmation');
    }

    public function acceptreservation(Request $request)
    {
        $confirmation = Confirmation::findOrFail($request->id);

        $confirmation->is_accepted = true;
        $confirmation->accepted_message = $request->accepted_message;
        $confirmation->save();

        $confirmation->triggerReservationAccepted();

        session()->flash('success', 'The confirmation reservation has been accepted, an email notification will be sent to the client');
        return redirect()->back();
    }

    public function rejectreservation(Request $request)
    {
        $confirmation = Confirmation::findOrFail($request->id);

        $confirmation->is_rejected = true;
        $confirmation->rejection_message = $request->rejection_message;
        $confirmation->save();

        $confirmation->triggerReservationRejected();

        session()->flash('success', 'The confirmation reservation has been rejected, an email notification will be sent to the client');
        return redirect()->back();
    }
}
