<?php

namespace App\Http\Controllers\Report\EventReservation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Reservation\Funeral;

class FuneralEventReportController extends Controller
{
    public function index(Request $request)
    {

        if(!is_null($request->name) || (!is_null($request->funeral_start) && !is_null($request->funeral_end)) || (!is_null($request->daterange_start) && !is_null($request->daterange_end))) {

            $filters = [];

            // Name
            !is_null($request->name) ? array_push($filters, ['name', 'like', '%'.$request->name.'%']) : null;

            // Funeral Date
            if(!is_null($request->funeral_start) || !is_null($request->funeral_end)){
                $request->validate([
                    'funeral_start' => 'date|required_with:funeral_end',
                    'funeral_end' => 'date'
                ]);
                $startDate = Carbon::createFromFormat('Y-m-d', $request->funeral_start)->toDateString();
                $endDate = Carbon::createFromFormat('Y-m-d', $request->funeral_end)->toDateString();

                array_push($filters, ['date', '>=', $startDate], ['date', '<=', $endDate]);
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

            return view('admin.report.event-reservation.funerallist', [
                'funerals' => Funeral::where($filters)->latest()->get()
            ]);

        }

        // Default
        return view('admin.report.event-reservation.funerallist', [
            'funerals' => Funeral::latest()->get()
        ]);

        
    }
}
