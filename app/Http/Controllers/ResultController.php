<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Imports\ResultsImport;
use Illuminate\Support\Facades\DB;
use App\Models\Result;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\ImportResultsJob;
use Illuminate\Support\Facades\Storage;
class ResultController extends Controller
{


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls,csv|max:102400', // 100MB max
    //         'exam_year' => 'required',
    //         'level' => 'required',
    //     ]);

    //     try {
    //         Excel::import(new ResultsImport(
    //             $request->exam_year,
    //             $request->level
    //         ), $request->file('file'));

    //         return response()->json([
    //             'message' => 'Results uploaded successfully'
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Error uploading results: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }



    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:102400',
            'exam_year' => 'required',
            'level' => 'required',
            // 'class' => 'required'
        ]);

        DB::beginTransaction();
        try {
            Excel::import(new ResultsImport(
                $request->exam_year,
                $request->level
            ), $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls,csv|max:102400', // 100MB max
    //         'exam_year' => 'required',
    //         'level' => 'required',
    //     ]);

    //     // Store the file and get the full path
    //     $file = $request->file('file');
    //     $filePath = $file->storeAs('imports', $file->getClientOriginalName());

    //     // Dispatch job with the absolute file path
    //     ImportResultsJob::dispatch(Storage::path($filePath), $request->exam_year, $request->level);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'File uploaded successfully! Data is processing in the background.'
    //     ]);
    // }




}
