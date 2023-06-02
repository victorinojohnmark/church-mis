<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\DocumentRequest;
use App\Models\DocumentRequest\DocumentRequestBaptism;

class DocumentRequestController extends Controller
{

    public function index()
    {
        $documentTypes = Storage::disk('json')->exists('document_type.json')? Storage::disk('json')->get('document_type.json') : '';

        if(Auth::user()->is_admin) {
            return view('admin.documentrequest.documentrequestlist', [

            ]);
        } else {
            return view('user.documentrequest.baptism.baptismlist', [

                'baptismRequests' => DocumentRequestBaptism::latest()->get(),
                'baptismRequest' => new DocumentRequestBaptism()
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

        switch ($request->document_type) {
            case 'Baptism':
                $details = $request->validate([
                    'baptismal_date' => ['required', 'date'],
                    'contact_number' => ['required'],
                    'birth_date' => ['required', 'date'],
                    'father_name' => ['required'],
                    'mother_name' => ['required'],
                    'address' => ['required'],
                    'purpose' => ['required']
                ]);

                if($request->id) {
                    $documentRequest = DocumentRequest::findOrFail($request->id);

                    if(!$documentRequest->is_ready){
                        $documentRequest->fill($data);
                        $baptismRequestDetail->fill($details);

                        $documentRequest->save();
                        $baptismRequestDetail->save();
                    }
                    session()->flash('success', 'Request updated successfully.');
                    return redirect()->back();
                } else {
                    $documentRequest = DocumentRequest::create($data);
                    $details['document_request_id'] = $documentRequest->id;

                    session()->flash('success', 'Request submitted successfully.');
                    return redirect()->back();
                }

                break;

            case 'Confirmation':
                $details = $request->validate([
                    'confirmation_date' => ['required', 'date'],
                    'contact_number' => ['required'],
                    'birth_date' => ['required', 'date'],
                    'father_name' => ['required'],
                    'mother_name' => ['required'],
                    'address' => ['required'],
                    'purpose' => ['required']
                ]);
                break;

            case 'First Holy Communion':
                $details = $request->validate([
                    'communion_date' => ['required', 'date'],
                    'contact_number' => ['required'],
                    'birth_date' => ['required', 'date'],
                    'father_name' => ['required'],
                    'mother_name' => ['required'],
                    'address' => ['required'],
                    'purpose' => ['required']
                ]);
                break;

            case 'Matrimony':
                $details = $request->validate([
                    # validate here
                ]);
                break;

            case 'Blessings':
                $details = $request->validate([
                    # validate here
                ]);
                break;

            case 'Death':
                $details = $request->validate([
                    # validate here
                ]);
                break;
            
            default:
                # code...
                break;
        }

        

        // dd($documentRequest);

        

    }

    public function setReady(Request $request)
    {
        $documentRequest = DocumentRequest::findOrFail($request->id);

        $documentRequest->is_ready = true;
        $documentRequest->save();

        $documentRequest->triggerDocumentReady();

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