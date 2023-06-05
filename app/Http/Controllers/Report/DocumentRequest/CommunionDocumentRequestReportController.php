<?php

namespace App\Http\Controllers\Report\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\DocumentRequest\DocumentRequestCommunion;

class CommunionDocumentRequestReportController extends Controller
{
    public function index(Request $request)
    {
        if(!is_null($request->name) || (!is_null($request->communion_start) && !is_null($request->communion_end)) || (!is_null($request->daterange_start) && !is_null($request->daterange_end))) {

            $filters = [];

            // Name
            !is_null($request->name) ? array_push($filters, ['name', 'like', '%'.$request->name.'%']) : null;

            // Communion Date
            if(!is_null($request->communion_start) || !is_null($request->communion_end)){
                $request->validate([
                    'communion_start' => 'date|required_with:communion_end',
                    'communion_end' => 'date'
                ]);
                $startDate = Carbon::createFromFormat('Y-m-d', $request->communion_start)->toDateString();
                $endDate = Carbon::createFromFormat('Y-m-d', $request->communion_end)->toDateString();

                array_push($filters, ['communion_date', '>=', $startDate], ['communion_date', '<=', $endDate]);
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

            return view('admin.report.document-request.communionlist', [
                'communionRequests' => DocumentRequestCommunion::where($filters)->latest()->get()
            ]);

        }
 
        // Default
        return view('admin.report.document-request.communionlist', [
            'communionRequests' => DocumentRequestCommunion::latest()->get()
        ]);
    }
}
