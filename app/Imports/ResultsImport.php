<?php

namespace App\Imports;

use App\Models\Result;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultsImport implements ToModel, WithHeadingRow
{
    private $exam_year;
    private $level;

    public function __construct($exam_year, $level)
    {
        $this->exam_year = $exam_year;
        $this->level = $level;
    }

    public function model(array $row)
    {
        return new Result([
            'roll_no' => $row['roll_no'],
            'student_name' => $row['student_name'],
            'class' => $row['class'],
            'exam_year' => $this->exam_year,
            'level' => $this->level,
            'marks' => $row['marks'],
            'status' => $row['marks'] >= 50 ? 'Pass' : 'Fail',
        ]);
    }
}
