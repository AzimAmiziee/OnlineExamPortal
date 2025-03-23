<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isLecturer()
    {
        return $this->role === 'lecturer';
    }
    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'student_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }





}
