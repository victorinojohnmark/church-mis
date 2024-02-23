<?php

namespace App\Http\Controllers\API\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\API\Events\StoreCommunionRequest;
use App\Models\Reservation\Communion;
use App\Models\CommunionDetail;
use Illuminate\Support\Facades\DB;

class CommunionController extends Controller
{
    public function show(Request $request, $communion)
    {
        $communion = Communion::with('details')->find($communion);

        if (!$communion) {
            return response()->json(['error' => 'Communion not found'], 404);
        }

        // return communion with communion details in JSON
        return response()->json($communion, 200);
    }

    public function store(StoreCommunionRequest $request)
    {

        DB::beginTransaction();
        try {
            $communion = Communion::create($request->validated());

            $details = json_decode($request->details, true);
            foreach ($details as $detail) {
                $detail['communion_id'] = $communion->id;
                CommunionDetail::create($detail);
            }

            if($request->hasFile('file')) {
                $uniqueFilename = uniqid() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $uniqueFilename, 'public');
                $communion->file = $filePath;
            }

            $communion->save();

            DB::commit();
            return response()->json($communion, 201);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
