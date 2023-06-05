<?php

namespace App\Http\Controllers\Report\DocumentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\DocumentRequest\DocumentRequestDeath;

class DeathDocumentRequestReportController extends Controller
{
    public function index(Request $request)
    {
        if(!is_null($request->name) || (!is_null($request->death_start) && !is_null($request->death_end)) || (!is_null($request->daterange_start) && !is_null($request->daterange_end))) {

            $filters = [];

            // Name
            !is_null($request->name) ? array_push($filters, ['name', 'like', '%'.$request->name.'%']) : null;

            // Date of Death
            if(!is_null($request->death_start) || !is_null($request->death_end)){
                $request->validate([
                    'death_start' => 'date|required_with:death_end',
                    'death_end' => 'date'
                ]);
                $startDate = Carbon::createFromFormat('Y-m-d', $request->death_start)->toDateString();
                $endDate = Carbon::createFromFormat('Y-m-d', $request->death_end)->toDateString();

                array_push($filters, ['date_of_death', '>=', $startDate], ['date_of_death', '<=', $endDate]);
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

            return view('admin.report.document-request.deathlist', [
                'deathRequests' => DocumentRequestDeath::where($filters)->latest()->get()
            ]);

        }
 
        // Default
        return view('admin.report.document-request.deathlist', [
            'deathRequests' => DocumentRequestDeath::latest()->get()
        ]);
    }
}
