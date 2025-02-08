<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Imports\ResultsImport;

use App\Models\Result;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ResultController extends Controller
{


    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'exam_year' => 'required',
            'level' => 'required',
        ]);

        try {
            Excel::import(new ResultsImport(
                $request->exam_year,
                $request->level
            ), $request->file('file'));

            return response()->json([
                'message' => 'Results uploaded successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error uploading results: ' . $e->getMessage()
            ], 500);
        }
    }














}
