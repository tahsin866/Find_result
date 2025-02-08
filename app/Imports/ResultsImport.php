<?php

namespace App\Imports;

use App\Models\FindResult;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResultsImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
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
        return new FindResult([
            'roll_no' => $row['roll'] ?? $row['roll_no'] ?? null,
            'student_name' => $row['name'] ?? $row['student_name'] ?? null,
            'class' => $row['class'] ?? null,
            'exam_year' => $this->exam_year,
            'level' => $this->level,
            'marks' => (int) ($row['mark'] ?? $row['marks'] ?? 0),
            'status' => ((int) ($row['mark'] ?? $row['marks'] ?? 0)) >= 50 ? 'Pass' : 'Fail',
        ]);
    }

    public function batchSize(): int
    {
        return 500; // Adjust batch size for better performance
    }

    public function chunkSize(): int
    {
        return 1000; // Adjust chunk size for large imports
    }
}
