<?php

namespace App\Http\Controllers\API\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\API\Events\StoreBlessingRequest;
use App\Models\Reservation\Blessing;

class BlessingController extends Controller
{
    public function store(StoreBlessingRequest $request)
    {
        DB::beginTransaction();
        try {
            $blessing = Blessing::create($request->validated());
            DB::commit();
            return response()->json($blessing);
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }    
}
