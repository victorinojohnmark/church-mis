<?php

namespace App\Http\Controllers\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest\DocumentRequestCommunion;

class DocumentRequestCommunionController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.communion.communionlist', [
                'communionRequests' => DocumentRequestCommunion::latest()->get()
            ]);
        } else {
            return view('user.documentrequest.communion.communionlist', [
                'communionRequests' => DocumentRequestCommunion::where('user_id', Auth::id())->get(),
                'communionRequest' => new DocumentRequestCommunion()
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
            return redirect()->back();
        } else {
            $documentRequestcommunion = DocumentRequestCommunion::create($data);

            session()->flash('success', 'Communion document request submitted successfully.');
            return redirect()->back();
        }

    }

    public function cancel(Request $request)
    {
        $documentRequestcommunion = DocumentRequestCommunion::findOrFail($request->id);

        $documentRequestcommunion->is_active = false;
        $documentRequestcommunion->save();

        session()->flash('warning', 'Your request has been successfully cancelled');
        return redirect()->back();

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
}
