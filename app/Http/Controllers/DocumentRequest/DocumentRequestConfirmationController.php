<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestConfirmation;

class DocumentRequestConfirmationController extends Controller
{
    //

    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.confirmation.confirmationlist', [
                'confirmationRequests' => DocumentRequestConfirmation::latest()->get()
            ]);
        } else {
            return view('user.documentrequest.confirmation.confirmationlist', [
                'confirmationRequests' => DocumentRequestConfirmation::where('user_id', Auth::id())->get(),
                'confirmationRequest' => new DocumentRequestConfirmation()
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required'],
            'birth_date' => ['required', 'date'],
            'contact_number' => ['required'],
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
            return redirect()->back();
        } else {
            $documentRequestConfirmation = DocumentRequestConfirmation::create($data);

            session()->flash('success', 'Confirmation document request submitted successfully.');
            return redirect()->back();
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestConfirmation = DocumentRequestConfirmation::findOrFail($request->id);

        $documentRequestConfirmation->is_active = false;
        $documentRequestConfirmation->save();

        session()->flash('warning', 'Your request has been successfully cancelled');
        return redirect()->back();

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
}
