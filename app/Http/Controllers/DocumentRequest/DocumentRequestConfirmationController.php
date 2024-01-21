<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestConfirmation;
use App\Models\Client;

class DocumentRequestConfirmationController extends Controller
{
    //

    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.confirmation.confirmationlist', [
                'confirmationRequests' => DocumentRequestConfirmation::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.documentrequest.confirmation.confirmationlist', [
                'confirmationRequests' => DocumentRequestConfirmation::where('user_id', Auth::id())->get(),
                'confirmationRequest' => new DocumentRequestConfirmation(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
    }

    public function show(Request $request, DocumentRequestConfirmation $confirmationRequest)
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(auth()->user()->id == $confirmationRequest->user_id) {
            return view('user.documentrequest.confirmation.confirmationview', [
                'confirmationRequest' => $confirmationRequest,
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        } else {
            abort(404);
        }
        
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.documentrequest.confirmation.confirmationcreate', [
            'confirmationRequest' => new DocumentRequestConfirmation(),
            'notificationCount' => $client->unreadNotifications->count()
        ]);
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required'],
            'birth_date' => ['required', 'date'],
            'sex' => ['required', 'in:Male,Female'],
            'relationship' => ['required', 'in:Grandmother,Grandfather,Mother,Father,Sibling,Myself'],
            'contact_number' => ['required','digits:11'],
            'confirmation_date' => ['required', 'date'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'address' => ['required'],
            'purpose' => ['required'],
            'requested_date' => ['required', 'date']
        ]);


         if($request->id) {
            $documentRequestConfirmation = DocumentRequestConfirmation::findOrFail($request->id);
            if(!$documentRequestConfirmation->is_ready){
                $documentRequestConfirmation->fill($data);
                $documentRequestConfirmation->save();
            }

            session()->flash('success', 'Confirmation document request updated successfully.');
            return redirect()->route('client-documentrequestconfirmationlist');
        } else {
            $documentRequestConfirmation = DocumentRequestConfirmation::create($data);

            session()->flash('success', 'Confirmation document request submitted successfully.');
            return redirect()->route('client-documentrequestconfirmationlist');
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestConfirmation = DocumentRequestConfirmation::findOrFail($request->id);

        if($documentRequestConfirmation->is_active && !$documentRequestConfirmation->is_rejected) {
            $documentRequestConfirmation->is_active = false;
            $documentRequestConfirmation->save();

            session()->flash('warning', 'Your request has been successfully cancelled');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Confirmation document request has been cancelled or rejected.');
            return redirect()->back();
        }

    }

    public function setReady(Request $request)
    {
        $documentRequestConfirmation = DocumentRequestConfirmation::findOrFail($request->id);

        if($documentRequestConfirmation->is_active) {
            $documentRequestConfirmation->is_ready = true;
            $documentRequestConfirmation->save();

            $documentRequestConfirmation->triggerSetReadyEvent();

            session()->flash('success', 'Confirmation document request updated, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Confirmation document request has been cancelled.');
            return redirect()->back();
        }
    }

    public function reject(Request $request)
    {
        $documentRequestConfirmation = DocumentRequestConfirmation::findOrFail($request->id);

        if($documentRequestConfirmation->is_active && !$documentRequestConfirmation->is_rejected) {
            $documentRequestConfirmation->is_rejected = true;
            $documentRequestConfirmation->rejection_message = $request->rejection_message;
            $documentRequestConfirmation->save();

            $documentRequestConfirmation->triggerRejectEvent();

            session()->flash('success', 'Confirmation document request rejected, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Confirmation document request has been cancelled or rejected.');
            return redirect()->back();
        }
    }
}
