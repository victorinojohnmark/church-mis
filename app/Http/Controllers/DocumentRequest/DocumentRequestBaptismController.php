<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestBaptism;
use App\Models\Client;

class DocumentRequestBaptismController extends Controller
{
    //

    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.baptism.baptismlist', [
                'baptismRequests' => DocumentRequestBaptism::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.documentrequest.baptism.baptismlist', [
                'baptismRequests' => DocumentRequestBaptism::where('user_id', Auth::id())->get(),
                'baptismRequest' => new DocumentRequestBaptism(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
    }

    public function show(Request $request, DocumentRequestBaptism $baptismRequest)
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(auth()->user()->id == $baptismRequest->user_id) {
            return view('user.documentrequest.baptism.baptismview', [
                'baptismRequest' => $baptismRequest,
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        } else {
            abort(404);
        }
        
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.documentrequest.baptism.baptismcreate', [
            'baptismRequest' => new DocumentRequestBaptism(),
            'notificationCount' => $client->unreadNotifications->count()
        ]);
        
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->is_unknown_date);

        $data = $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required'],
            'birth_date' => ['required', 'date'],
            'birth_place' => ['required', 'max:255'],
            'sex' => ['required', 'in:Male,Female'],
            'relationship' => ['required', 'in:Grandmother,Grandfather,Mother,Father,Sibling,Myself'],
            'contact_number' => ['required','digits:11'],
            'is_unknown_date' => ['nullable'],
            'baptismal_date' => ['required_if:is_unknown_date,null', 'date'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'address' => ['required'],
            'purpose' => ['required'],
            'requested_date' => ['required', 'date']
        ]);

        // dd($request->all());

        // dd($request->is_unknown_date);

        $data['baptism_date'] = $request->is_unknown_date ? null : $request->baptismal_date;


         if($request->id) {
            $documentRequestBaptism = DocumentRequestBaptism::findOrFail($request->id);
            if(!$documentRequestBaptism->is_ready){
                $documentRequestBaptism->fill($data);
                $documentRequestBaptism->save();
            }

            session()->flash('success', 'Baptism document request updated successfully.');
            return redirect()->route('client-documentrequestbaptismlist');
        } else {
            $documentRequestBaptism = DocumentRequestBaptism::create($data);

            session()->flash('success', 'Baptism document request submitted successfully.');
            return redirect()->route('client-documentrequestbaptismlist');
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
