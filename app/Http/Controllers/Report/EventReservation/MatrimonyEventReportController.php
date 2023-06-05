<?php

namespace App\Http\Controllers\Report\EventReservation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Reservation\Matrimony;

class MatrimonyEventReportController extends Controller
{
    public function index(Request $request)
    {

        if(!is_null($request->grooms_name) || !is_null($request->brides_name) || (!is_null($request->matrimony_start) && !is_null($request->matrimony_end)) || (!is_null($request->daterange_start) && !is_null($request->daterange_end))) {

            $filters = [];

            // Groom's Name
            !is_null($request->grooms_name) ? array_push($filters, ['grooms_name', 'like', '%'.$request->grooms_name.'%']) : null;

            // Brides's Name
            !is_null($request->brides_name) ? array_push($filters, ['brides_name', 'like', '%'.$request->brides_name.'%']) : null;

            // Matrimony Date
            if(!is_null($request->matrimony_start) || !is_null($request->matrimony_end)){
                $request->validate([
                    'matrimony_start' => 'date|required_with:matrimony_end',
                    'matrimony_end' => 'date'
                ]);
                $startDate = Carbon::createFromFormat('Y-m-d', $request->matrimony_start)->toDateString();
                $endDate = Carbon::createFromFormat('Y-m-d', $request->matrimony_end)->toDateString();

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

            return view('admin.report.event-reservation.matrimonylist', [
                'matrimonies' => Matrimony::where($filters)->latest()->get()
            ]);

        }

        // Default
        return view('admin.report.event-reservation.matrimonylist', [
            'matrimonies' => Matrimony::latest()->get()
        ]);

        
    }
}
