<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentRequestController extends Controller
{

    public function index()
    {
        $documentTypes = Storage::disk('json')->exists('document_type.json')? Storage::disk('json')->get('document_type.json') : '';

        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.documentrequestlist', [
                'documentTypes' => json_decode($documentTypes),
                'documentRequests' => DocumentRequest::latest()->get(),
            ]);
        } else {
            return view('user.documentrequest.documentrequestlist', [
                'documentTypes' => json_decode($documentTypes),
                'documentRequests' => DocumentRequest::latest()->where('user_id', Auth::id())->get(),
                'documentRequest' => new DocumentRequest()
            ]);
        }
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer'],
            'name' => ['required'],
            'document_type' => ['required', 'max:50'],
            'requested_date' => ['required', 'date'],
        ]);

        if($request->id) {
            $documentRequest = DocumentRequest::findOrFail($request->id);
            if(!$documentRequest->is_ready){
                $documentRequest->fill($data);
                $documentRequest->save();
            }

            session()->flash('success', 'Request updated successfully.');
            return redirect()->back();
        } else {
            $documentRequest = DocumentRequest::create($data);
            session()->flash('success', 'Request submitted successfully.');
            return redirect()->back();
        }

        // dd($documentRequest);

        

    }

    public function setReady(Request $request)
    {
        $documentRequest = DocumentRequest::findOrFail($request->id);

        $documentRequest->is_ready = true;
        $documentRequest->save();

        session()->flash('success', 'Document Request updated, email notification will be sent to the client');
        return redirect()->back();

    }

    public function cancel(Request $request)
    {
        //cancel document request
        $documentRequest = DocumentRequest::findOrFail($request->id);

        $documentRequest->is_active = false;
        $documentRequest->save();

        session()->flash('success', 'Your ' . strtolower($documentRequest->document_type) . ' document request(' . $documentRequest->request_code . ') has been cancelled.');
        return redirect()->back();
    }

}