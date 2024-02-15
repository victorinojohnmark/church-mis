<?php

namespace App\Http\Controllers\API\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\API\Events\StoreBaptismRequest;
use App\Models\Reservation\Baptism;

class BaptismController extends Controller
{
    public function store(StoreBaptismRequest $request)
    {
        DB::beginTransaction();
        try {
            $baptism = Baptism::create($request->validated());
            DB::commit();
            return response()->json($baptism, 201);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
        
    }
}
