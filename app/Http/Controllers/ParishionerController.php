<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ParishionerController extends Controller
{
    public function index()
    {
        return view('admin.parishioner.parishionerlist', [
            'parishioners' => User::parishioner()->orderBy('name')->get()
        ]);
    }
}
