<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Reservation\Baptism;
use App\Models\Reservation\Blessing;
use App\Models\Reservation\Communion;
use App\Models\Reservation\Confirmation;
use App\Models\Reservation\Funeral;
use App\Models\Reservation\Matrimony;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Event::whereDate('start', '>=', $request->start)
            //     ->whereDate('end',   '<=', $request->end)
            //     ->get(['id', 'title', 'start', 'end']);
            return response()->json($this->cleanEvents($request));
        }

        return view('calendar');
    }

    public function cleanEvents(Request $request)
    {
        $data = [];

        //fetch all reservation and consolidate on $data 

        //baptism 
        $baptisms = Baptism::whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($baptisms as $baptism) {
            array_push($data, [
                'id' => $baptism->id,
                'title' => 'Baptism event for ' . $baptism->name,
                'start' => $baptism->date,
                'end' => $baptism->date
            ]);
        }

        $blessings = Blessing::whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($blessings as $blessing) {
            array_push($data, [
                'id' => $blessing->id,
                'title' => 'Blessing event for ' . $blessing->name,
                'start' => $blessing->date,
                'end' => $blessing->date
            ]);
        }

        $communions = Communion::whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($communions as $communion) {
            array_push($data, [
                'id' => $communion->id,
                'title' => 'Communion event for ' . $communion->name,
                'start' => $communion->date,
                'end' => $communion->date
            ]);
        }

        $confirmations = Confirmation::whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($confirmations as $confirmation) {
            array_push($data, [
                'id' => $confirmation->id,
                'title' => 'Confirmation event for ' . $confirmation->name,
                'start' => $confirmation->date,
                'end' => $confirmation->date
            ]);
        }

        $funerals = Funeral::whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($funerals as $funeral) {
            array_push($data, [
                'id' => $funeral->id,
                'title' => 'Funeral event for ' . $funeral->name,
                'start' => $funeral->date,
                'end' => $funeral->date
            ]);
        }

        $matrimonys = Matrimony::whereDate('wedding_date', '>=', $request->start)
            ->whereDate('wedding_date', '<=', $request->end)
            ->get();

        foreach ($matrimonys as $matrimony) {
            array_push($data, [
                'id' => $matrimony->id,
                'title' => 'Matrimony event for ' . $matrimony->grooms_name . ' & ' . $matrimony->brides_name,
                'start' => $matrimony->wedding_date,
                'end' => $matrimony->wedding_date
            ]);
        }



        return $data;


    }
}
