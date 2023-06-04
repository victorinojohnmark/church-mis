<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\Document;

class DocumentReportController extends Controller
{
    public function index(Request $request)
    {
        $documentTypes = Storage::disk('json')->exists('document_type.json')? Storage::disk('json')->get('document_type.json') : '';

        if(!is_null($request->name) || !is_null($request->document_type) || (!is_null($request->daterange_start) && !is_null($request->daterange_end))) {

            $filters = [];

            // Name
            !is_null($request->name) ? array_push($filters, ['name', 'like', '%'.$request->name.'%']) : null;

            // Document Type
            !is_null($request->document_type) ? array_push($filters, ['document_type', '=', $request->document_type]) : null;

            // Document Type
            !is_null($request->document_type) ? array_push($filters, ['document_type', '=', $request->document_type]) : null;

            //Date Range
            if(!is_null($request->daterange_start) || !is_null($request->daterange_end)){
                $request->validate([
                    'daterange_start' => 'date|required_with:daterange_end',
                    'daterange_end' => 'date'
                ]);
                $startDate = Carbon::createFromFormat('Y-m-d', $request->daterange_start)->toDateString();
                $endDate = Carbon::createFromFormat('Y-m-d', $request->daterange_end)->toDateString();

                array_push($filters, ['created_at', '>=', $startDate], ['created_at', '<=', $endDate]);
            }

            return view('admin.report.documentlist', [
                'documents' => Document::where($filters)->latest()->get(),
                'documentTypes' => json_decode($documentTypes),
            ]);

        }

        return view('admin.report.documentlist', [
            'documents' => Document::latest()->get(),
            'documentTypes' => json_decode($documentTypes),
        ]);
    }
}
