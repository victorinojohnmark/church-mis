<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Document;
use App\Models\User;


class DocumentController extends Controller
{

    public function index()
    {
        $documentTypes = Storage::disk('json')->exists('document_type.json')? Storage::disk('json')->get('document_type.json') : '';

        return view('admin.document.documentlist', [
            'documents' => Document::latest()->get(),
            'documentTypes' => json_decode($documentTypes),
            'parishioners' => User::parishioner()->orderBy('name')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required'],
            'document_type' => ['required'],
            'filename' => ['required', 'image', 'max:5120'],
            'date' => ['required', 'date']
        ]);

        $file = $request->file('filename');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = uniqid() . now()->timestamp . '.' .$extension;
        $file->storeAs('public/documents', $filename, 'local');

        $document = Document::create([
            'user_id' => $request->user_id,
            'document_type' => $request->document_type,
            'filename' => $filename,
            'date' => $request->date
        ]);

        session()->flash('success', 'Request submitted successfully.');
        return redirect()->back();
    }

    public function show(Document $document)
    {
        //
    }

    public function update(Request $request, Document $document)
    {
        //
    }

    public function destroy(Document $document)
    {
        //
    }
}
