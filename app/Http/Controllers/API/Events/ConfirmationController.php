<?php

namespace App\Http\Controllers\API\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\API\Events\StoreConfirmationRequest;

use App\Models\Reservation\Confirmation;
use App\Models\ConfirmationDetail;

class ConfirmationController extends Controller
{
    public function show(Request $request, $confirmation)
    {
        $confirmation = Confirmation::with('details')->find($confirmation);

        if (!$confirmation) {
            return response()->json(['error' => 'Confirmation not found'], 404);
        }

        // return confirmation with confirmation details in JSON
        return response()->json($confirmation, 200);
    }

    public function store(StoreConfirmationRequest $request)
    {

        DB::beginTransaction();
        try {
            $confirmation = Confirmation::create($request->validated());

            $details = json_decode($request->details, true);
            foreach ($details as $detail) {
                $detail['confirmation_id'] = $confirmation->id;
                ConfirmationDetail::create($detail);
            }

            if($request->hasFile('file')) {
                $uniqueFilename = uniqid() . '_' . $request->file('file')->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $uniqueFilename, 'public');
                $confirmation->file = $filePath;
            }

            $confirmation->save();

            DB::commit();
            return response()->json($confirmation, 201);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    
}
