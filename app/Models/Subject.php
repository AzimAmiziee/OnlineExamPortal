<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration'];

    public function studentClasses()
    {
        return $this->belongsToMany(StudentClass::class, 'subject_student_class');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
