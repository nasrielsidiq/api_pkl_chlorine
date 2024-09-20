<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function school(){
        $this->belongsTo(School::class,'npsn','npsn');
    }

    protected $fillable = [
        'nisn',
        'full_name',
        'birth_day',
        'adress',
        'major',
        'npsn',
    ];
}
