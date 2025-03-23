<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_text',
        'subject_id',
        'type',
        'option1',
        'option2',
        'option3',
        'option4',
        'correct_option',
        'correct_answer'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
