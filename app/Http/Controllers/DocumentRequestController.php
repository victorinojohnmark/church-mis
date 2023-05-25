<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest;
use App\Models\Payment;

class DocumentRequestController extends Controller
{

    public function index()
    {
        if (Auth::user()->is_admin) {
            return view('admin.document-request.documentrequestlist', [
                'documentRequests' => DocumentRequest::active()->latest()->get()
            ]);
        } else {
            $documentTypes = Storage::disk('json')->exists('document_type.json')? Storage::disk('json')->get('document_type.json') : '';

            return view('user.documentrequest', [
                'documentTypes' => json_decode($documentTypes),
                'documentRequests' => DocumentRequest::active()->where('user_id', Auth::id())->latest()->get(),
                'documentRequest' => new DocumentRequest()
            ]);
        }
        
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
            'payment_amount' => ['required', 'integer'],
            'proof_of_payment' => ['required', 'image', 'max:5120']
        ]);

        // Create document request
        $documentRequest = DocumentRequest::create($data);

        // Create payment record
        $file = $request->file('proof_of_payment');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . now()->timestamp . '.' .$extension;
        $file->storeAs('public/payments', $filename, 'local');

        Payment::create([
            'user_id' => Auth::id(), 
            'document_request_id' => $documentRequest->id, 
            'amount' => $request->payment_amount, 
            'proof_of_payment_file' => $filename
        ]);

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

        // check if status is pending, allow cancellation only if the status is pending
        if($documentRequest->status != 'Pending') {
            session()->flash('danger', 'The cancellation request was unsuccessful as the document is either currently being processed or is ready for pickup.');
            return redirect()->back();
        }

        $documentRequest->is_active = false;
        $documentRequest->save();

        session()->flash('success', 'Your ' . strtolower($documentRequest->document_type) . ' document request(' . $documentRequest->request_code . ') has been cancelled.');
        return redirect()->back();
    }
}
