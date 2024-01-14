<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestDeath;

class DocumentRequestDeathController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.death.deathlist', [
                'deathRequests' => DocumentRequestDeath::latest()->get()
            ]);
        } else {
            return view('user.documentrequest.death.deathlist', [
                'deathRequests' => DocumentRequestDeath::where('user_id', Auth::id())->get(),
                'deathRequest' => new DocumentRequestDeath()
            ]);
        }
    }

    public function show(Request $request, DocumentRequestDeath $deathRequest)
    {
        if(auth()->user()->id == $deathRequest->user_id) {
            return view('user.documentrequest.death.deathview', [
                'deathRequest' => $deathRequest
            ]);
        } else {
            abort(404);
        }
        
    }

    public function create(Request $request)
    {
        return view('user.documentrequest.death.deathcreate', [
            'deathRequest' => new DocumentRequestDeath()
        ]);
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'name' => ['required'],
            'age' => ['required'],
            'status' => ['required'],
            // 'religion' => ['required'],
            'date_of_death' => ['required', 'date'],
            'cause_of_death' => ['required'],
            'address' => ['required'],
            'contact_person' => ['required'],
            'contact_number' => ['required','digits:11'],
            'requested_date' => ['required', 'date']
        ]);


         if($request->id) {
            $documentRequestDeath = DocumentRequestDeath::findOrFail($request->id);
            if(!$documentRequestDeath->is_ready){
                $documentRequestDeath->fill($data);
                $documentRequestDeath->save();
            }

            session()->flash('success', 'Death document request updated successfully.');
            return redirect()->route('client-documentrequestdeathlist');
        } else {
            $documentRequestDeath = DocumentRequestDeath::create($data);

            session()->flash('success', 'Death document request submitted successfully.');
            return redirect()->route('client-documentrequestdeathlist');
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestDeath = DocumentRequestDeath::findOrFail($request->id);

        if($documentRequestDeath->is_active && !$documentRequestDeath->is_rejected) {
            $documentRequestDeath->is_active = false;
            $documentRequestDeath->save();

            session()->flash('warning', 'Your request has been successfully cancelled');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Death document request has been cancelled or rejected.');
            return redirect()->back();
        }
        
    }

    public function setReady(Request $request)
    {
        $documentRequestDeath = DocumentRequestDeath::findOrFail($request->id);

        if($documentRequestDeath->is_active) {
            $documentRequestDeath->is_ready = true;
            $documentRequestDeath->save();

            $documentRequestDeath->triggerSetReadyEvent();

            session()->flash('success', 'Death document request updated, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Death document request has been cancelled.');
            return redirect()->back();
        }
    }

    public function reject(Request $request)
    {
        $documentRequestDeath = DocumentRequestDeath::findOrFail($request->id);

        if($documentRequestDeath->is_active && !$documentRequestDeath->is_rejected) {
            $documentRequestDeath->is_rejected = true;
            $documentRequestDeath->rejection_message = $request->rejection_message;
            $documentRequestDeath->save();

            $documentRequestDeath->triggerRejectEvent();

            session()->flash('success', 'Death document request rejected, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Death document request has been cancelled or rejected.');
            return redirect()->back();
        }
    }
}
