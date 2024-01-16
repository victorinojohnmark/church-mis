<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestBlessing;
use App\Models\Client;

class DocumentRequestBlessingController extends Controller
{
    public function index()
    {
        $client = Client::findOrFail(auth()->user()->id);
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.blessing.blessinglist', [
                'blessingRequests' => DocumentRequestBlessing::latest()->get()
            ]);
        } else {
            return view('user.documentrequest.blessing.blessinglist', [
                'blessingRequests' => DocumentRequestBlessing::where('user_id', Auth::id())->get(),
                'blessingRequest' => new DocumentRequestBlessing()
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'name' => ['required'],
            'blessing_type' => ['required'],
            'blessing_date' => ['required', 'date'],
            'address' => ['required'],
            'contact_number' => ['required','digits:11'],
            'requested_date' => ['required', 'date']
        ]);


         if($request->id) {
            $documentRequestblessing = DocumentRequestBlessing::findOrFail($request->id);
            if(!$documentRequestblessing->is_ready){
                $documentRequestblessing->fill($data);
                $documentRequestblessing->save();
            }

            session()->flash('success', 'Blessing document request updated successfully.');
            return redirect()->back();
        } else {
            $documentRequestblessing = DocumentRequestBlessing::create($data);

            session()->flash('success', 'Blessing document request submitted successfully.');
            return redirect()->back();
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestblessing = DocumentRequestBlessing::findOrFail($request->id);

        if($documentRequestblessing->is_active && !$documentRequestblessing->is_rejected) {
            $documentRequestblessing->is_active = false;
            $documentRequestblessing->save();

            session()->flash('warning', 'Your request has been successfully cancelled');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Blessing document request has been cancelled or rejected.');
            return redirect()->back();
        }

    }

    public function setReady(Request $request)
    {
        $documentRequestblessing = DocumentRequestBlessing::findOrFail($request->id);

        if($documentRequestblessing->is_active) {
            $documentRequestblessing->is_ready = true;
            $documentRequestblessing->save();

            $documentRequestblessing->triggerSetReadyEvent();

            session()->flash('success', 'Blessing document request updated, email notification will be sent to the client.');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Blessing document request has been cancelled.');
            return redirect()->back();
        }
    }

    public function reject(Request $request)
    {
        $documentRequestBlessing = DocumentRequestBlessing::findOrFail($request->id);

        if($documentRequestBlessing->is_active && !$documentRequestBlessing->is_rejected) {
            $documentRequestBlessing->is_rejected = true;
            $documentRequestBlessing->rejection_message = $request->rejection_message;
            $documentRequestBlessing->save();

            $documentRequestBlessing->triggerRejectEvent();

            session()->flash('success', 'Blessing document request rejected, email notification will be sent to the client');
            return redirect()->back();
        } else {
            session()->flash('danger', 'Invalid, Blessing document request has been cancelled or rejected.');
            return redirect()->back();
        }
    }
}
