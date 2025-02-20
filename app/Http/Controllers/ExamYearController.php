<?php

namespace App\Http\Controllers;

use App\Models\exam_year;
use Illuminate\Http\Request;

class ExamYearController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bangla_year' => 'required|string',
            'arabic_year' => 'required|string',
            'english_year' => 'required|string'
        ]);

        $examYear = exam_year::create($validated);

        return response()->json([
            'message' => 'Exam year created successfully',
            'data' => $examYear
        ], 201);
    }

    public function index()
    {
        $examYears = exam_year::all();
        return response()->json($examYears);
    }
}
