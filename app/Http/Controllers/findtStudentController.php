<?php

namespace App\Http\Controllers;


use App\Models\student;
use App\Models\students_number_potrro;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mpdf\Mpdf;
// use PDF;

use Barryvdh\DomPDF\Facade\Pdf;
use MirazMac\BanglaString\Translator\BijoyToAvro\Translator;
use Mpdf\Tag\Select;

class findtStudentController extends Controller
{





    public function search(Request $request)
    {
        // Fetch distinct years in descending order
        $years = student::distinct()->orderBy('years', 'desc')->pluck('years');

        // Define marhalas
        $marhalas = [
            1 => 'তাকমিল',
            2 => 'ফযিলত',
            3 => 'সানাবিয়া উলইয়া',
            4 => 'সানাবিয়া',
            5 => 'মুতায়াসসিতা',
            6 => 'ইবতেদাইয়্যা',
            7 => 'হিফজুল কোরান',
            8 => 'ইলমুল কিরাত',
        ];

        // Initialize results
        $results = [];

        // Check if required fields are filled
        if ($request->filled(['CID', 'years', 'Roll', 'reg_id'])) {
            $translator = new Translator();

            // Fetch students with the given criteria
            $students = student::where([
                'CID' => $request->CID,
                'years' => $request->years,
                'Roll' => $request->Roll,
                'reg_id' => $request->reg_id,
            ])->select('Name', 'Father', 'Roll', 'reg_id', 'Madrasha', 'Total', 'Division', 'Positions',
                       'SubLabel_1', 'SubValue_1', 'SubLabel_2', 'SubValue_2',
                       'SubLabel_3', 'SubValue_3', 'SubLabel_4', 'SubValue_4',
                       'SubLabel_5', 'SubValue_5', 'SubLabel_6', 'SubValue_6',
                       'SubLabel_7', 'SubValue_7', 'SubLabel_8', 'SubValue_8')
              ->get();

            // Translate fields in bulk
            $results = $students->map(function ($student) use ($translator) {
                $fieldsToTranslate = ['Name', 'Father', 'Madrasha', 'Division', 'Roll', 'reg_id', 'Total', 'Positions'];
                foreach ($fieldsToTranslate as $field) {
                    $student->$field = $translator->translate($student->$field);
                }

                for ($i = 1; $i <= 8; $i++) {
                    $labelKey = "SubLabel_$i";
                    if (!empty($student->$labelKey)) {
                        $student->$labelKey = $translator->translate($student->$labelKey);
                    }
                }

                return $student;
            });
        }

        // Return the data to the view
        return Inertia::render('find_result/studentResultFind', [
            'availableYears' => $years,
            'marhalas' => $marhalas,
            'searchResults' => [
                'data' => $results
            ]
        ]);
    }


    public function marhalaFind(Request $request)
    {
        $years = student::select('years')
            ->distinct()
            ->orderBy('years', 'desc')
            ->pluck('years');

        $marhalas = [
            1 => 'তাকমিল',
            2 => 'ফযিলত',
            3 => 'সানাবিয়া উলইয়া',
            4 => 'সানাবিয়া',
            5 => 'মুতায়াসসিতা',
            6 => 'ইবতেদাইয়্যা',
            7 => 'হিফজুল কোরান',
            8 => 'ইলমুল কিরাত',
        ];

        $results = [];

        if ($request->CID && $request->years && $request->MElhaq) {
            $translator = new Translator();

            $results = student::where('CID', $request->CID)
                ->where('years', $request->years)
                ->where('MElhaq', $request->MElhaq)
                ->orderBy('Roll', 'asc')
                ->paginate(15)
                ->through(function ($student) use ($translator) {
                    // Convert Bijoy to Unicode
                    $student->Madrasha = $translator->translate($student->Madrasha);
                    $student->Name = $translator->translate($student->Name);
                    $student->MElhaq = $translator->translate($student->MElhaq);
                    $student->Division = $translator->translate($student->Division);
                    $student->Class = $translator->translate($student->Class);
                    // $student->reg_id = $translator->translate($student->reg_id);
                    // $student->Total = $translator->translate($student->Total);
                    // $student->Positions = $translator->translate($student->Positions);

                    // Translate subject labels
                    for ($i = 1; $i <= 8; $i++) {
                        $labelKey = "SubLabel_" . $i;
                        if (!empty($student->$labelKey)) {
                            $student->$labelKey = $translator->translate($student->$labelKey);
                        }
                    }

                    return $student;
                });
        }

        return Inertia::render('find_result/marhalawariFindResult', [
            'availableYears' => $years,
            'marhalas' => $marhalas,
            'searchResults' => $results
        ]);
    }














    public function merit_list(Request $request)
    {
        $years = student::select('years')
            ->distinct()
            ->orderBy('years', 'desc')
            ->pluck('years');

        $marhalas = [
            1 => 'তাকমিল',
            2 => 'ফযিলত',
            3 => 'সানাবিয়া উলইয়া',
            4 => 'সানাবিয়া',
            5 => 'মুতায়াসসিতা',
            6 => 'ইবতেদাইয়্যা',
            7 => 'হিফজুল কোরান',
            8 => 'ইলমুল কিরাত',
        ];

        $SRtype = [
            1 => 'ছাত্র',
            0 => 'ছাত্রী',
        ];

        $results = [];

        $students = collect();

        if ($request->CID && $request->years && $request->SRtype) {
            $translator = new Translator();

            // Query with pagination
            $students = student::where('CID', $request->CID)
                ->where('years', $request->years)
                ->where('SRtype', $request->SRtype)
                ->whereNotNull('Positions')
                ->where('Positions', '!=', '')
                ->orderByRaw("LENGTH(Positions), Positions ASC")
                ->orderBy('Roll', 'asc')
                ->paginate(30)
                ->through(function ($student) use ($translator) {
                    // Convert Bijoy to Unicode and translate fields
                    $student->Madrasha = $translator->translate($student->Madrasha);
                    $student->Name = $translator->translate($student->Name);
                    $student->SRtype = $translator->translate($student->SRtype);
                    $student->Division = $translator->translate($student->Division);
                    $student->Class = $translator->translate($student->Class);
                    $student->Positions = $translator->translate($student->Positions);

                    // Translate subject labels
                    for ($i = 1; $i <= 8; $i++) {
                        $labelKey = "SubLabel_" . $i;
                        if (!empty($student->$labelKey)) {
                            $student->$labelKey = $translator->translate($student->$labelKey);
                        }
                    }

                    return $student;
                });
        }

        return Inertia::render('find_result/merit_list', [
            'availableYears' => $years,
            'marhalas' => $marhalas,
            'SRtype' => $SRtype,
            'searchResults' => $students, // Properly formatted paginated result
            'canLogin' => true
        ]);
    }





    // public function generatePdf($Roll, $reg_id, $action = 'D')
    // {
    //     $details = student::where('Roll', $Roll)
    //         ->where('reg_id', $reg_id)
    //         ->firstOrFail();

    //     $pdf = PDF::loadView('pdf.studentpdf', compact('details'))
    //         ->setPaper('A4')
    //         ->setOptions([
    //             'defaultFont' => 'SolaimanLipi',
    //             'isHtml5ParserEnabled' => true,
    //             'isRemoteEnabled' => true
    //         ]);

    //     $filename = "result-{$Roll}-{$reg_id}.pdf";

    //     return $action === 'I' ? $pdf->stream($filename) : $pdf->download($filename);
    // }



    // public function generatePdf($Roll, $reg_id, $action = 'D')
    // {
    //     $details = Student::where('Roll', $Roll)
    //                      ->where('reg_id', $reg_id)
    //                      ->firstOrFail();

    //     $mpdf = new \Mpdf\Mpdf([
    //         'mode' => 'utf-8',
    //         'format' => 'A4',
    //         'autoScriptToLang' => true,
    //         'autoLangToFont' => true,
    //         'autoVietnamese' => true,
    //         'autoArabic' => true,
    //         'margin_left' => 15,
    //         'margin_right' => 15,
    //         'margin_top' => 16,
    //         'margin_bottom' => 16,
    //         'margin_header' => 9,
    //         'margin_footer' => 9,
    //         'fontDir' => array_merge((new \Mpdf\Config\ConfigVariables())->getDefaults()['fontDir'], [
    //             public_path('fonts')
    //         ]),
    //         'fontdata' => [
    //             'solaimanlipi' => [
    //                 'R' => 'SolaimanLipi.ttf',
    //                 'useOTL' => 0xFF,
    //                 'useKashida' => 75,
    //             ]
    //         ],
    //         'default_font_size' => 14
    //     ]);

    //     $mpdf->SetDirectionality('ltr');
    //     $mpdf->SetFont('solaimanlipi');

    //     $html = view('pdf.studentpdf', [
    //         'details' => $details
    //     ])->render();

    //     $mpdf->SetDisplayMode('fullpage');
    //     $mpdf->SetHTMLFooter('Page {PAGENO} of {nb}');
    //     $mpdf->WriteHTML($html);

    //     $filename = "result-{$Roll}-{$reg_id}.pdf";

    //     return $mpdf->Output($filename, $action);
    // }







}
