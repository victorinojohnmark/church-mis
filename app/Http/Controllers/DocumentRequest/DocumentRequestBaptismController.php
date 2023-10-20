<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestBaptism;

class DocumentRequestBaptismController extends Controller
{
    //

    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.baptism.baptismlist', [
                'baptismRequests' => DocumentRequestBaptism::latest()->get()
            ]);
        } else {
            return view('user.documentrequest.baptism.baptismlist', [
                'baptismRequests' => DocumentRequestBaptism::where('user_id', Auth::id())->get(),
                'baptismRequest' => new DocumentRequestBaptism()
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required'],
            'birth_date' => ['required', 'date'],
            'contact_number' => ['required','digits:11'],
            'baptismal_date' => ['required', 'date'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'address' => ['required'],
            'purpose' => ['required'],
            'requested_date' => ['required', 'date']
        ]);


         if($request->id) {
            $documentRequestBaptism = DocumentRequestBaptism::findOrFail($request->id);
            if(!$documentRequestBaptism->is_ready){
                $documentRequestBaptism->fill($data);
                $documentRequestBaptism->save();
            }

            session()->flash('success', 'Baptism document request updated successfully.');
            return redirect()->back();
        } else {
            $documentRequestBaptism = DocumentRequestBaptism::create($data);

            session()->flash('success', 'Baptism document request submitted successfully.');
            return redirect()->back();
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestBaptism = DocumentRequestBaptism::findOrFail($request->id);
        if($documentRequestBaptism->is_active && !$documentRequestBaptism->is_rejected) {
            $documentRequestBaptism->is_active = false;
            $documentRequestBaptism->save();

            session()->flash('warning', 'Your request has been successfully cancelled');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Baptism document request has been cancelled or rejected.');
            return redirect()->back();
        }

        

    }

    public function setReady(Request $request)
    {
        $documentRequestBaptism = DocumentRequestBaptism::findOrFail($request->id);

        if($documentRequestBaptism->is_active) {
            $documentRequestBaptism->is_ready = true;
            $documentRequestBaptism->save();

            $documentRequestBaptism->triggerSetReadyEvent();

            session()->flash('success', 'Baptism document request updated, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Confirmation document request has been cancelled.');
            return redirect()->back();
        }
    }

    public function reject(Request $request)
    {
        $documentRequestBaptism = DocumentRequestBaptism::findOrFail($request->id);

        if($documentRequestBaptism->is_active && !$documentRequestBaptism->is_rejected) {
            $documentRequestBaptism->is_rejected = true;
            $documentRequestBaptism->rejection_message = $request->rejection_message;
            $documentRequestBaptism->save();

            $documentRequestBaptism->triggerRejectEvent();

            session()->flash('success', 'Baptism document request rejected, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Baptism document request has been cancelled or rejected.');
            return redirect()->back();
        }
    }
}
