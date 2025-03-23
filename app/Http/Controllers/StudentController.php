<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $studentClass = $user->studentClass;
        $subjects = $studentClass ? $studentClass->subjects : collect([]);

        return view('student.dashboard', compact('studentClass', 'subjects'));
    }

    public function result()
    {
        $results = auth()->user()->results;
        return view('student.result', compact('results'));
    }
}
