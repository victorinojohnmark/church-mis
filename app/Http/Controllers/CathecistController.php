<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;

class CathecistController extends Controller
{
    public function index()
    {
        return view('admin.cathecist.cathecistlist', [
            'cathecists' => User::cathecist()->orderBy('name')->get(),
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.cathecist.cathecistform', [
            'cathecist' => new User()
        ]);
    }

    public function store(Request $request)
    {
        if($request->id) {
            $cathecist = User::findOrFail($request->id);
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'birth_date' => ['required', 'date'],
                'sex' => ['required', 'in:Male,Female'],
                'address' => ['required'],
                'contact_number' => ['required', 'digits:11'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    'unique:users,id,',
                    Rule::unique('users')->ignore($request->id),
                ],
                'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            ]);
    
            $cathecist->fill($data);
            $cathecist->save();
    
            return redirect()->route('cathecistlist')->with('success', 'Cathecist updated successfully');
        } else {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'birth_date' => ['required', 'date'],
                'sex' => ['required', 'in:Male,Female'],
                'address' => ['required'],
                'contact_number' => ['required', 'digits:11'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
    
            $data['is_cathecist'] = true;
    
            $user = User::create($data);
    
            return redirect()->route('cathecistlist')->with('success', 'Cathecist created successfully');
        }
        

    }

    public function show(User $cathecist)
    {
        return view('admin.cathecist.cathecistform', [
            'cathecist' => $cathecist
        ]);
    }

    public function update(Request $request, User $cathecist)
    {
        

    }

    public function reservation()
    {
        $client = User::findOrFail(auth()->user()->id);
        $eventReservations = EventReservation::where('user_id', Auth::id())->get();

        return view('user.eventreservation', [
            'eventReservations' => $eventReservations,
            'notificationCount' => $client->unreadNotifications->count()
        ]);
    }
}
