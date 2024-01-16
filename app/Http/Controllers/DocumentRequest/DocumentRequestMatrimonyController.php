<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestMatrimony;
use App\Models\Client;

class DocumentRequestMatrimonyController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.matrimony.matrimonylist', [
                'matrimonyRequests' => DocumentRequestMatrimony::latest()->get(),
                'notificationCount' => auth()->user()->unreadNotifications->count()
            ]);
        } else {
            return view('user.documentrequest.matrimony.matrimonylist', [
                'matrimonyRequests' => DocumentRequestMatrimony::where('user_id', Auth::id())->get(),
                'matrimonyRequest' => new DocumentRequestMatrimony(),
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        }
    }

    public function show(Request $request, DocumentRequestMatrimony $matrimonyRequest)
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(auth()->user()->id == $matrimonyRequest->user_id) {
            return view('user.documentrequest.matrimony.matrimonyview', [
                'matrimonyRequest' => $matrimonyRequest,
                'notificationCount' => $client->unreadNotifications->count()
            ]);
        } else {
            abort(404);
        }
        
    }

    public function create(Request $request)
    {
        $client = Client::findOrFail(auth()->user()->id);
        return view('user.documentrequest.matrimony.matrimonycreate', [
            'matrimonyRequest' => new DocumentRequestMatrimony(),
            'notificationCount' => $client->unreadNotifications->count()
        ]);
        
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
            'contact_number' => ['required','digits:11'],
            'address' => ['required'],
            'requested_date' => ['required', 'date'],
        ]);


         if($request->id) {
            $documentRequestmatrimony = DocumentRequestMatrimony::findOrFail($request->id);
            if(!$documentRequestmatrimony->is_ready){
                $documentRequestmatrimony->fill($data);
                $documentRequestmatrimony->save();
            }

            session()->flash('success', 'Wedding document request updated successfully.');
            return redirect()->route('client-documentrequestmatrimonylist');
        } else {
            $documentRequestmatrimony = DocumentRequestMatrimony::create($data);

            session()->flash('success', 'Wedding document request submitted successfully.');
            return redirect()->route('client-documentrequestmatrimonylist');
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestmatrimony = DocumentRequestMatrimony::findOrFail($request->id);

        if($documentRequestmatrimony->is_active && !$documentRequestmatrimony->is_rejected) {
            $documentRequestmatrimony->is_active = false;
            $documentRequestmatrimony->save();

            session()->flash('warning', 'Your request has been successfully cancelled');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Matrimony document request has been cancelled or rejected.');
            return redirect()->back();
        }

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

    public function reject(Request $request)
    {
        $documentRequestMatrimony = DocumentRequestMatrimony::findOrFail($request->id);

        if($documentRequestMatrimony->is_active && !$documentRequestMatrimony->is_rejected) {
            $documentRequestMatrimony->is_rejected = true;
            $documentRequestMatrimony->rejection_message = $request->rejection_message;
            $documentRequestMatrimony->save();

            $documentRequestMatrimony->triggerRejectEvent();

            session()->flash('success', 'Matrimony document request rejected, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Matrimony document request has been cancelled or rejected.');
            return redirect()->back();
        }
    }
}
