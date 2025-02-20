<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class exam_year extends Model
{
    //
    protected $fillable = [
        'bangla_year',
        'arabic_year',
        'english_year'
    ];
}
