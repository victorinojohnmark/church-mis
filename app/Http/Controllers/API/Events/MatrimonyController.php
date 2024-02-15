<?php

namespace App\Http\Controllers\API\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Reservation\Matrimony;
use App\Http\Requests\API\Events\StoreMatrimonyRequest;

class MatrimonyController extends Controller
{
    public function store(StoreMatrimonyRequest $request)
    {
        DB::beginTransaction();
        try {
            $matrimony = Matrimony::create($request->validated());
            DB::commit();
            return response()->json($matrimony);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }   
}
