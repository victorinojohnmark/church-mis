<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\DocumentRequest;

class UserController extends Controller
{
    public function show()
    {
        return view('user.profile', [
            'user' => Auth::user()
        ]);
    }

    // public function userdocrequest()
    // {
    //     $documentTypes = Storage::disk('json')->exists('document_type.json')? Storage::disk('json')->get('document_type.json') : '';

    //     return view('user.documentrequest', [
    //         'documentTypes' => json_decode($documentTypes),
    //         'documentRequest' => new DocumentRequest()
    //     ]);
    // }

    public function update(Request $request)
    {
        $user = user::findOrFail(Auth::id());

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'address' => ['required'],
            'contact_number' => ['required']
        ]);

        $user->fill($data);
        $user->save();

        session()->flash('success', 'User profile updated successfully.');

        return redirect()->back();
    }
}
