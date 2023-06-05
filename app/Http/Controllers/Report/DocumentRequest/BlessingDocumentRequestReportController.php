<?php

namespace App\Http\Controllers\Report\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\DocumentRequest\DocumentRequestBlessing;

class BlessingDocumentRequestReportController extends Controller
{
    public function index(Request $request)
    {
        if(!is_null($request->name) || !is_null($request->blessing_type) || (!is_null($request->blessing_start) && !is_null($request->blessing_end)) || (!is_null($request->daterange_start) && !is_null($request->daterange_end))) {

            $filters = [];

            // Name
            !is_null($request->name) ? array_push($filters, ['name', 'like', '%'.$request->name.'%']) : null;

            // Blessing Type
            !is_null($request->blessing_type) ? array_push($filters, ['blessing_type', 'like', $request->blessing_type]) : null;

            // Blessing Date
            if(!is_null($request->blessing_start) || !is_null($request->blessing_end)){
                $request->validate([
                    'blessing_start' => 'date|required_with:blessing_end',
                    'blessing_end' => 'date'
                ]);
                $startDate = Carbon::createFromFormat('Y-m-d', $request->blessing_start)->toDateString();
                $endDate = Carbon::createFromFormat('Y-m-d', $request->blessing_end)->toDateString();

                array_push($filters, ['blessing_date', '>=', $startDate], ['blessing_date', '<=', $endDate]);
            }

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

            return view('admin.report.document-request.blessinglist', [
                'blessingRequests' => DocumentRequestBlessing::where($filters)->latest()->get()
            ]);

        }
 
        // Default
        return view('admin.report.document-request.blessinglist', [
            'blessingRequests' => DocumentRequestBlessing::latest()->get()
        ]);
    }
}
