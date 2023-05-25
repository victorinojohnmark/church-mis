<?php

namespace App\Http\Controllers;

use App\Models\DocumentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentRequestController extends Controller
{

    public function index()
    {
        $documentTypes = Storage::disk('json')->exists('document_type.json')? Storage::disk('json')->get('document_type.json') : '';

        return view('user.documentrequest', [
            'documentTypes' => json_decode($documentTypes),
            'documentRequests' => DocumentRequest::active()->latest()->get(),
            'documentRequest' => new DocumentRequest()
        ]);
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer'],
            'document_type' => ['required', 'max:50'],
            'requested_date' => ['required', 'date'],
        ]);

        $documentRequest = DocumentRequest::create($data);

        // dd($documentRequest);

        session()->flash('success', 'Request submitted successfully.');
        return redirect()->back();

    }

    public function show(DocumentRequest $documentRequest)
    {
        //
    }

    public function edit(DocumentRequest $documentRequest)
    {
        //
    }

    public function update(Request $request, DocumentRequest $documentRequest)
    {
        //
    }

    public function destroy(DocumentRequest $documentRequest)
    {
        //
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
