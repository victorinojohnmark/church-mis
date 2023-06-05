<?php

namespace App\Http\Controllers\Report\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\DocumentRequest\DocumentRequestBaptism;

class BaptismDocumentRequestReportController extends Controller
{
    public function index(Request $request)
    {
        if(!is_null($request->name) || (!is_null($request->baptism_start) && !is_null($request->baptism_end)) || (!is_null($request->daterange_start) && !is_null($request->daterange_end))) {

            $filters = [];

            // Name
            !is_null($request->name) ? array_push($filters, ['name', 'like', '%'.$request->name.'%']) : null;

            // Baptismal Date
            if(!is_null($request->baptism_start) || !is_null($request->baptism_end)){
                $request->validate([
                    'baptism_start' => 'date|required_with:baptism_end',
                    'baptism_end' => 'date'
                ]);
                $startDate = Carbon::createFromFormat('Y-m-d', $request->baptism_start)->toDateString();
                $endDate = Carbon::createFromFormat('Y-m-d', $request->baptism_end)->toDateString();

                array_push($filters, ['baptismal_date', '>=', $startDate], ['baptismal_date', '<=', $endDate]);
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

            return view('admin.report.document-request.baptismlist', [
                'baptismRequests' => DocumentRequestBaptism::where($filters)->latest()->get()
            ]);

        }
 
        // Default
        return view('admin.report.document-request.baptismlist', [
            'baptismRequests' => DocumentRequestBaptism::latest()->get()
        ]);
    }
}
