<?php

namespace App\Http\Controllers\API\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\API\Events\StoreFuneralRequest;
use App\Models\Reservation\Funeral;

class FuneralController extends Controller
{
    public function store(StoreFuneralRequest $request)
    {
        DB::beginTransaction();
        try {
            $funeral = Funeral::create($request->validated());
            DB::commit();
            return response()->json($funeral);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }   
}
