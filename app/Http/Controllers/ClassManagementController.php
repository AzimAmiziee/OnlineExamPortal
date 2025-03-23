<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class ClassManagementController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        $studentClasses = StudentClass::all();

        return view('lecturer.classes.index', compact('students', 'studentClasses'));
    }



    // Store a new class
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        StudentClass::create([
            'name' => $request->name,
            'created_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Class created successfully.');
    }

    public function assign()
    {
        $students = User::where('role', 'student')->get();
        $studentClasses = StudentClass::all();

        return view('lecturer.classes.assign', compact('students', 'studentClasses'));
    }



    // Assign a student to a class
    public function assignToStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:student_classes,id',
        ]);

        $student = User::findOrFail($request->student_id);
        $student->class_id = $request->class_id;
        $student->save();

        return redirect()->back()->with('success', 'Student assigned to class successfully.');
    }


}
