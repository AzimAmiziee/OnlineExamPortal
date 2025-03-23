<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'score',
        'exam_date',
        'grade',
    ];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }


    // Relationship to the exam subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
