<?php

namespace App\Imports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultsImport implements ToModel, WithHeadingRow
{
    private $exam_year;
    private $marhala;
    private $class;

    public function __construct($exam_year, $marhala, $class)
    {
        $this->exam_year = $exam_year;
        $this->marhala = $marhala;
        $this->class = $class;
    }

    public function model(array $row)
    {
        return new Result([
            'roll_no' => $row['roll_no'],
            'student_name' => $row['student_name'],
            'class' => $this->class,
            'exam_year' => $this->exam_year,
            'marhala' => $this->marhala,
            'marks' => $row['marks']
        ]);
    }
}
