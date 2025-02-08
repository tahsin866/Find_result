<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class findResult extends Model
{
    protected $table = 'find-results';

    protected $fillable = [
        'roll_no',
        'student_name',
        'class',
        'exam_year',
        'level',
        'marks',
        'status'
    ];
}
