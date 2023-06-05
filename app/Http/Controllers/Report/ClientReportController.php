<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client;

class ClientReportController extends Controller
{
    public function index()
    {
        return view('admin.report.clientlist', [
            'clients' => Client::orderBy('name')->get()
        ]);
    }
}
