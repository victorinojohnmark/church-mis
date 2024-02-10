<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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
            return response()->json($this->cleanEvents($request));
        }

        return response()->json($this->cleanEvents($request));

        // return view('calendar');
    }

    public function cleanEvents(Request $request)
    {
        $data = [];

        //baptism 
        $baptisms = Baptism::accepted()->whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($baptisms as $baptism) {
            array_push($data, [
                'id' => $baptism->id,
                'title' => 'Baptism event for ' . $baptism->name,
                'start' => $baptism->date . ' ' . $baptism->time,
                'end' => $baptism->date,
                'color' => '#FF0000'
            ]);
        }

        $blessings = Blessing::accepted()->whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($blessings as $blessing) {
            array_push($data, [
                'id' => $blessing->id,
                'title' => 'Blessing event for ' . $blessing->name,
                'start' => $blessing->date . ' ' . $blessing->time,
                'end' => $blessing->date,
                'color' => '#00FF00'
            ]);
        }

        $communions = Communion::accepted()->whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($communions as $communion) {
            array_push($data, [
                'id' => $communion->id,
                'title' => 'Communion event for ' . $communion->name,
                'start' => $communion->date,
                'end' => $communion->date,
                'color' => '#0000FF'
            ]);
        }

        $confirmations = Confirmation::accepted()->whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($confirmations as $confirmation) {
            array_push($data, [
                'id' => $confirmation->id,
                'title' => 'Confirmation event for ' . $confirmation->name,
                'start' => $confirmation->date,
                'end' => $confirmation->date,
                'color' => '#FFA500'
            ]);
        }

        $funerals = Funeral::accepted()->whereDate('date', '>=', $request->start)
            ->whereDate('date', '<=', $request->end)
            ->get();

        foreach ($funerals as $funeral) {
            array_push($data, [
                'id' => $funeral->id,
                'title' => 'Funeral event for ' . $funeral->name,
                'start' => $funeral->date . ' ' . $funeral->time,
                'end' => $funeral->date,
                'color' => '#87CEEB'
            ]);
        }

        $matrimonys = Matrimony::accepted()->whereDate('wedding_date', '>=', $request->start)
            ->whereDate('wedding_date', '<=', $request->end)
            ->get();

        foreach ($matrimonys as $matrimony) {
            array_push($data, [
                'id' => $matrimony->id,
                'title' => 'Wedding event for ' . $matrimony->grooms_name . ' & ' . $matrimony->brides_name,
                'start' => $matrimony->wedding_date . ' ' . $matrimony->time,
                'end' => $matrimony->wedding_date,
                'color' => '#EE82EE'
            ]);
        }



        return $data;


    }

    public function userCalender(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->cleanEvents($request));
        }

        return view('user.calendar');
    }

    public function adminCalender(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->cleanEvents($request));
        }

        return view('admin.calendar');
    }
}
