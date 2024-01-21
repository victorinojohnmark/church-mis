<?php

namespace App\Http\Controllers\Reservation;

use App\Models\Reservation\Communion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

use App\Models\Client;

class CommunionController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin) {
            return view('admin.communion.communionlist', [
                'communions' => Communion::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.communion.communionlist', [
                'communions' => Communion::where('created_by_id', Auth::id())->get(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
    }

    public function show(Request $request, Communion $communion)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.communion.communionview', [
            'communion' => $communion,
            'notificationCount' => $client->unreadNotifications->count()
        ]);
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.communion.communioncreate', [
            'communion' => new Communion(),
            'notificationCount' => $client->unreadNotifications->count()
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
            'contact_number' => ['required','digits:11'],
            'created_by_id' => ['required'],
            'file' => 'required|mimes:csv'
        ], [
            'date.after_or_equal' => 'The date field should not be older that today.',
            'date.not_on_monday' => 'Date reservation for mondays is not valid.',
            'file.mimes' => 'The file type must be in .csv.'
        ]);

        if($request->id) {

            $communion = Communion::findOrFail($request->id);
            $communion->fill($data);
            
            if($request->hasFile('file')) {
                $uniqueFilename = uniqid() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $uniqueFilename, 'public');
                $communion->file = $filePath;
            }

            $communion->save();

            session()->flash('success', 'Communion Reservation updated successfully.');
        } else {
            //check first if date is already taken
            // $isDateTaken = Communion::where('date', $data['date'])->exists();
            // if($isDateTaken) {
            //     session()->flash('danger', 'Date submitted was already taken');
            //     return redirect()->back();
            // }

            if($request->hasFile('file')) {
                $uniqueFilename = uniqid() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $uniqueFilename, 'public');
                $data['file'] = $filePath;
            }

            $communion = Communion::create($data);
            session()->flash('success', 'Communion Reservation created successfully.');
        }

        return redirect()->route('clientcommunion');
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
