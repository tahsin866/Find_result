<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'roll_no',
        'student_name',
        'class',
        'exam_year',
        'marhala',
        'marks'
    ];
}
