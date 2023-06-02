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
            // return view('admin.documentrequest.documentrequestlist', [
            //     // 'documentTypes' => json_decode($documentTypes),
            //     // 'documentRequests' => DocumentRequest::latest()->get(),
            // ]);
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
            'contact_number' => ['required'],
            'baptismal_date' => ['required', 'date'],
            'father_name' => ['required'],
            'mother_name' => ['required'],
            'address' => ['required'],
            'purpose' => ['required'],
            'requested_date' => ['required', 'date']
        ]);


         if($request->id) {
            $documentRequest = DocumentRequestBaptism::findOrFail($request->id);
            if(!$documentRequest->is_ready){
                $documentRequest->fill($data);
                $documentRequest->save();
            }

            session()->flash('success', 'Baptism document request updated successfully.');
            return redirect()->back();
        } else {
            $documentRequest = DocumentRequestBaptism::create($data);

            session()->flash('success', 'Baptism document request submitted successfully.');
            return redirect()->back();
        }

    }
}
