<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\students_number_potrro;
use Illuminate\Http\Request;
use Inertia\Inertia;
class findtStudentController extends Controller
{




    public function search(Request $request)
    {
        $years = students_number_potrro::select('years')
            ->distinct()
            ->orderBy('years', 'desc')
            ->pluck('years');

        $marhalas = [
            2 => 'ফযিলত',
            3 => 'সানাবিয়া উলইয়া',
        ];

        $results = [];

        if ($request->filled(['CID', 'years', 'Roll', 'reg_id'])) {
            $results = students_number_potrro::where([
                'CID' => $request->CID,
                'years' => $request->years,
                'Roll' => $request->Roll,
                'reg_id' => $request->reg_id,
            ])->get();
        }

        return Inertia::render('find_result/studentResultFind', [
            'availableYears' => $years,
            'marhalas' => $marhalas,
            'searchResults' => [
                'data' => $results
            ]
        ]);
    }

















}
