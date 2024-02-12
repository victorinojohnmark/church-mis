<?php

namespace App\Http\Controllers\API\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\Events\StoreBaptismRequest;
use App\Models\Reservation\Baptism;

class BaptismController extends Controller
{
    public function store(StoreBaptismRequest $request)
    {
        $baptism = Baptism::create($request->validated());

        return response()->json($baptism, 201);
    }
}
