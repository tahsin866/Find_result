<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\student;
use App\Models\madrasha;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class students_number_potrro extends Model
{

    protected $fillable = [
        'Name',
        'BirthRegistrationNo_nid_no',
        'st_en_name',
        'Father',
        'mobileNumber',
        'st_en_Fname',
        'Elhaq',
        'DateofBirth'
    ];




    protected $table = 'students_number_potrro';
    protected $primarykey = 'MID';
    public $timestamps = false; // Add this if you don't have timestamp columns


    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'MID', 'MID');
    }



 public function madrasha(): BelongsTo
    {
        return $this->belongsTo(Madrasha::class, 'MID', 'id');
    }

}
