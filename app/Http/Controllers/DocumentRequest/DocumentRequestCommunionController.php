<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestCommunion;
use App\Models\Client;

class DocumentRequestCommunionController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.communion.communionlist', [
                'communionRequests' => DocumentRequestCommunion::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.documentrequest.communion.communionlist', [
                'communionRequests' => DocumentRequestCommunion::where('user_id', Auth::id())->get(),
                'communionRequest' => new DocumentRequestCommunion(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
    }

    public function show(Request $request, DocumentRequestCommunion $communionRequest)
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(auth()->user()->id == $communionRequest->user_id) {
            return view('user.documentrequest.communion.communionview', [
                'communionRequest' => $communionRequest,
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        } else {
            abort(404);
        }
        
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.documentrequest.communion.communioncreate', [
            'communionRequest' => new DocumentRequestCommunion(),
            'notificationCount' => $client->unreadNotifications->count()
        ]);
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required'],
            'birth_date' => ['required', 'date'],
            'contact_number' => ['required','digits:11'],
            'sex' => ['required', 'in:Male,Female'],
            'relationship' => ['required', 'in:Grandmother,Grandfather,Mother,Father,Sibling,Myself'],
            'communion_date' => ['required', 'date'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'address' => ['required'],
            'purpose' => ['required'],
            'requested_date' => ['required', 'date']
        ]);


         if($request->id) {
            $documentRequestcommunion = DocumentRequestCommunion::findOrFail($request->id);
            if(!$documentRequestcommunion->is_ready){
                $documentRequestcommunion->fill($data);
                $documentRequestcommunion->save();
            }

            session()->flash('success', 'Communion document request updated successfully.');
            return redirect()->route('client-documentrequestcommunionlist');
        } else {
            $documentRequestcommunion = DocumentRequestCommunion::create($data);

            session()->flash('success', 'Communion document request submitted successfully.');
            return redirect()->route('client-documentrequestcommunionlist');
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestcommunion = DocumentRequestCommunion::findOrFail($request->id);

        if($documentRequestcommunion->is_active && !$documentRequestcommunion->is_rejected) {
            $documentRequestcommunion->is_active = false;
            $documentRequestcommunion->save();

            session()->flash('warning', 'Your request has been successfully cancelled');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Communion document request has been cancelled or rejected.');
            return redirect()->back();
        }

    }

    public function setReady(Request $request)
    {
        $documentRequestcommunion = DocumentRequestCommunion::findOrFail($request->id);

        if($documentRequestcommunion->is_active) {
            $documentRequestcommunion->is_ready = true;
            $documentRequestcommunion->save();

            $documentRequestcommunion->triggerSetReadyEvent();

            session()->flash('success', 'Communion document request updated, email notification will be sent to the client.');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Communion document request has been cancelled.');
            return redirect()->back();
        }
    }

    public function reject(Request $request)
    {
        $documentRequestCommunion = DocumentRequestCommunion::findOrFail($request->id);

        if($documentRequestCommunion->is_active && !$documentRequestCommunion->is_rejected) {
            $documentRequestCommunion->is_rejected = true;
            $documentRequestCommunion->rejection_message = $request->rejection_message;
            $documentRequestCommunion->save();

            $documentRequestCommunion->triggerRejectEvent();

            session()->flash('success', 'Communion document request rejected, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Communion document request has been cancelled or rejected.');
            return redirect()->back();
        }
    }
}
