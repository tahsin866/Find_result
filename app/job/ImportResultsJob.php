<?php


namespace App\Jobs;

use App\Imports\ResultsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ImportResultsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $examYear;
    protected $level;

    public function __construct($filePath, $examYear, $level)
    {
        $this->filePath = $filePath;
        $this->examYear = $examYear;
        $this->level = $level;
    }

    public function handle()
    {
        Excel::import(new ResultsImport($this->examYear, $this->level), Storage::path($this->filePath));
    }
}
