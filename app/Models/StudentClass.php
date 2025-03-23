<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $fillable = ['name', 'created_by'];

    public function students()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_student_class');
    }

}
