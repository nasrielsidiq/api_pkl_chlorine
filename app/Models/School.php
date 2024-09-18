<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $primaryKey = 'npsn';

    protected $fillable = ['npsn','name','address','icon','headmaster'];

    public function School(){
        $this->hasMany(Student::class,'npsn');
    }
}
