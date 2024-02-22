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
    public function show(Request $request, Communion $communion)
    {
        
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

            DB::commit();
            return response()->json($communion, 201);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
