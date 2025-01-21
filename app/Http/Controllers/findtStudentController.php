<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\students_number_potrro;
use Illuminate\Http\Request;
use Inertia\Inertia;
use MirazMac\BanglaString\Translator\BijoyToAvro\Translator;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;





class findtStudentController extends Controller
{





    public function search(Request $request)
    {
        $years = student::distinct()
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

        if ($request->filled(['CID', 'years', 'Roll', 'reg_id'])) {
            $translator = new Translator();

            $results = student::where([
                'CID' => $request->CID,
                'years' => $request->years,
                'Roll' => $request->Roll,
                'reg_id' => $request->reg_id,
            ])->get()->map(function ($student) use ($translator) {
                // Convert Bijoy to Unicode using the correct method
                $student->Name = $translator->translate($student->Name);
                $student->Father = $translator->translate($student->Father);
                $student->Madrasha = $translator->translate($student->Madrasha);
                $student->Division = $translator->translate($student->Division);
                $student->Roll = $translator->translate($student->Roll);
                $student->reg_id = $translator->translate($student->reg_id);
                $student->Total = $translator->translate($student->Total);
                $student->Positions = $translator->translate($student->Positions);

                for ($i = 1; $i <= 8; $i++) {
                    $labelKey = "SubLabel_" .  $i;
                    if (!empty($student->$labelKey)) {
                        $student->$labelKey = $translator->translate($student->$labelKey);
                    }
                }

                return $student;
            });
        }

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
            5 => 'মুতায়াসসিতা',
            6 => 'ইবতেদাইয়্যা',
            7 => 'হিফজুল কোরান',
            7 => 'ইলমুল কিরাত',
        ];

        $results = [];

        if ($request->CID && $request->years && $request->MElhaq) {
            $results = student::where('CID', $request->CID)
                ->where('years', $request->years)
                ->where('MElhaq', $request->MElhaq)
                ->orderBy('Roll', 'asc')
                ->paginate(10); // Paginate with 10 results per page
        }

        return Inertia::render('find_result/marhalawariFindResult', [
            'availableYears' => $years,
            'marhalas' => $marhalas,
            'searchResults' => $results // Pagination data will include links, current page, etc.
        ]);
    }





    public function generatePdf($Roll, $reg_id, $action = 'D')
    {
        $details = student::where('CID', 2)
            ->where('Roll', $Roll)
            ->where('reg_id', $reg_id)
            ->firstOrFail();

        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $fontData['SolaimanLipi'] = [
            'R' => 'SolaimanLipi.ttf',
        ];

        $customPaper = 'A4';
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'tempDir' => storage_path('app/mpdf'),
            'fontDir' => array_merge($fontDirs, [public_path('fonts')]),
            'fontdata' => $fontData,
            'format' => $customPaper,
        ]);

        $html = view('pdf.studentpdf', compact('details'))->render();
        $mpdf->WriteHTML($html);

        // 'I' for inline preview/print, 'D' for download
        return response($mpdf->Output('', $action), 200, [
            'Content-Type' => 'application/pdf'
        ]);
    }







}
