<?php

namespace App\Http\Controllers\Catechist;

use App\Http\Controllers\Controller;
use App\Models\Reservation\Communion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Csv\Reader;

class DashboardController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('csv_file');

        // Read the CSV file
        $csv = Reader::createFromPath($file->getPathname(), 'r');
        $csv->setHeaderOffset(0);

        // Get the CSV data
        $data = $csv->getRecords();

        foreach ($data as $row) {
            Communion::insert([
                'name' => $row['Name'],
                'birth_date' => $row['Birth Date'],
                'mothers_name' => $row['Guardian'],
                'contact_number' => $row['Contact Number'],
                'present_address' => $row['Present Address'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // Redirect or show success message
        return redirect()->back()->with('success', 'CSV data has been saved to the database.');
    }
}
