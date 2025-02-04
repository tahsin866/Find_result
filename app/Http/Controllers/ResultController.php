<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Imports\ResultsImport;

use App\Models\Result;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ResultController extends Controller
{
    //
    public function index()
    {
        $examYears = [
            '48 তম কেন্দ্রীয় পরীক্ষা',
            '47 তম কেন্দ্রীয় পরীক্ষা',
            '46 তম কেন্দ্রীয় পরীক্ষা',
            '45 তম কেন্দ্রীয় পরীক্ষা'
        ];

        $marhalas = [
            'ফযিলত',
            'সানাবিয়া উলইয়া',
            'সানাবিয়া',
            'মুতাওয়াসসিতা',
            'ইবতেদাইয়্যাহ',
            'হিফজুল কোরান',
            'ইলমুত তাজবিদ ওয়াল কিরাত'
        ];

        return Inertia::render('Results/Upload', [
            'examYears' => $examYears,
            'marhalas' => $marhalas,
            'results' => Result::latest()->get()
        ]);
    }



   public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,csv',
        'exam_year' => 'required',
        'marhala' => 'required',
        'class' => 'required'
    ]);

    try {
        $file = $request->file('file');

        Excel::import(new ResultsImport(
            $request->exam_year,
            $request->marhala,
            $request->class
        ), $file);

        return redirect()->back()->with('success', 'Results imported successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while importing the file: ' . $e->getMessage());
    }
}
}
