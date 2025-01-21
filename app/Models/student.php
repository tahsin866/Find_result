<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{

protected $table ='students';

    protected $fillable = [
        'Name',


        'Father',

        'DateofBirth'
    ];


    public function madrasha(): BelongsTo
    {
        return $this->belongsTo(Madrasha::class, 'MID', 'id');
    }

    public function numberPotrro(): BelongsTo
    {
        return $this->belongsTo(students_number_potrro::class, 'MID', 'MID');
    }



}
