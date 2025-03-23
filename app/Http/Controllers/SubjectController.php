<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\StudentClass;

class SubjectController extends Controller
{
    // Display the subject management page
    public function index()
    {
        $subjects = Subject::with('studentClasses')->get();
        $studentClasses = StudentClass::all();
        return view('lecturer.subjects.index', compact('subjects', 'studentClasses'));
    }

    // Store a new subject
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:0', // duration in minutes; adjust rules as needed
            'student_class_ids' => 'required|array',
            'student_class_ids.*' => 'exists:student_classes,id',
        ]);

        // Create the subject with name and duration
        $subject = Subject::create([
            'name' => $request->name,
            'duration' => $request->duration,
        ]);

        // Attach classes to subject
        $subject->studentClasses()->attach($request->student_class_ids);

        return redirect()->route('subject.manage')->with('success', 'Subject created successfully.');
    }

    // Show edit form for a subject
    public function edit(Subject $subject)
    {
        $studentClasses = StudentClass::all();
        // Load attached classes for pre-selection
        $subject->load('studentClasses');
        return view('lecturer.subjects.edit', compact('subject', 'studentClasses'));
    }

    // Update the subject
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:0',
            'student_class_ids' => 'required|array',
            'student_class_ids.*' => 'exists:student_classes,id',
        ]);

        $subject->update([
            'name' => $request->name,
            'duration' => $request->duration,
        ]);

        // Sync the pivot table data for classes
        $subject->studentClasses()->sync($request->student_class_ids);

        return redirect()->route('subject.manage')->with('success', 'Subject updated successfully.');
    }

    // Delete a subject
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subject.manage')->with('success', 'Subject deleted successfully.');
    }
}
