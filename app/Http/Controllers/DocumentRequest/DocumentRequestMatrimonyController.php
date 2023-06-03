<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestMatrimony;

class DocumentRequestMatrimonyController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.matrimony.matrimonylist', [
                'matrimonyRequests' => DocumentRequestMatrimony::latest()->get()
            ]);
        } else {
            return view('user.documentrequest.matrimony.matrimonylist', [
                'matrimonyRequests' => DocumentRequestMatrimony::where('user_id', Auth::id())->get(),
                'matrimonyRequest' => new DocumentRequestMatrimony()
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'grooms_name' => ['required'],
            'grooms_birth_date' => ['required', 'date'],
            'brides_name' => ['required'],
            'brides_birth_date' => ['required', 'date'],
            'matrimony_date' => ['required', 'date'],
            'contact_number' => ['required'],
            'address' => ['required'],
            'requested_date' => ['required', 'date'],
        ]);


         if($request->id) {
            $documentRequestmatrimony = DocumentRequestMatrimony::findOrFail($request->id);
            if(!$documentRequestmatrimony->is_ready){
                $documentRequestmatrimony->fill($data);
                $documentRequestmatrimony->save();
            }

            session()->flash('success', 'matrimony document request updated successfully.');
            return redirect()->back();
        } else {
            $documentRequestmatrimony = DocumentRequestMatrimony::create($data);

            session()->flash('success', 'matrimony document request submitted successfully.');
            return redirect()->back();
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestmatrimony = DocumentRequestMatrimony::findOrFail($request->id);

        $documentRequestmatrimony->is_active = false;
        $documentRequestmatrimony->save();

        session()->flash('warning', 'Your request has been successfully cancelled');
        return redirect()->back();

    }

    public function setReady(Request $request)
    {
        $documentRequestmatrimony = DocumentRequestMatrimony::findOrFail($request->id);

        if($documentRequestmatrimony->is_active) {
            $documentRequestmatrimony->is_ready = true;
            $documentRequestmatrimony->save();

            $documentRequestmatrimony->triggerSetReadyEvent();

            session()->flash('success', 'Matrimony document request updated, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Matrimony document request has been cancelled.');
            return redirect()->back();
        }
    }
}
