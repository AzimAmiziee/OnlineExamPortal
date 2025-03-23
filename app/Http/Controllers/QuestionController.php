<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Subject;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::all();
        $subjectId = $request->input('subject_id');

        if ($subjectId) {
            $questions = Question::with('subject')->where('subject_id', $subjectId)->get();
        } else {
            $questions = Question::with('subject')->get();
        }

        return view('lecturer.questions.index', compact('questions', 'subjects'));
    }

    public function store(Request $request)
    {
        $baseRules = [
            'question_text' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'type' => 'required|in:multiple_choice,open_answer',
        ];

        if ($request->type === 'multiple_choice') {
            $rules = array_merge($baseRules, [
                'option1' => 'required|string',
                'option2' => 'required|string',
                'option3' => 'required|string',
                'option4' => 'required|string',
                'correct_option' => 'required|integer|in:1,2,3,4',
            ]);
        } else {
            $rules = array_merge($baseRules, [
                'correct_answer' => 'nullable|string',
            ]);
        }

        $validated = $request->validate($rules);

        // For open answer questions, fill multiple choice fields with dummy data.
        if ($validated['type'] === 'open_answer') {
            $validated['option1'] = $validated['option2'] = $validated['option3'] = $validated['option4'] = '';
            $validated['correct_option'] = null;
        }

        Question::create($validated);

        return redirect()->route('question.manage')->with('success', 'Question created successfully.');
    }

    // Show edit form for a specific question.
    public function edit(Question $question)
    {
        $subjects = Subject::all();
        return view('lecturer.questions.edit', compact('question', 'subjects'));
    }

    // Update the question.
    public function update(Request $request, Question $question)
    {
        $baseRules = [
            'question_text' => 'required|string',
            'subject_id' => 'required|exists:subjects,id',
            'type' => 'required|in:multiple_choice,open_answer',
        ];

        if ($request->type === 'multiple_choice') {
            $rules = array_merge($baseRules, [
                'option1' => 'required|string',
                'option2' => 'required|string',
                'option3' => 'required|string',
                'option4' => 'required|string',
                'correct_option' => 'required|integer|in:1,2,3,4',
            ]);
        } else {
            $rules = array_merge($baseRules, [
                'correct_answer' => 'nullable|string',
            ]);
        }

        $validated = $request->validate($rules);

        if ($validated['type'] === 'open_answer') {
            $validated['option1'] = $validated['option2'] = $validated['option3'] = $validated['option4'] = '';
            $validated['correct_option'] = null;
        }

        $question->update($validated);

        return redirect()->route('question.manage')->with('success', 'Question updated successfully.');
    }

    // Delete a question.
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('question.manage')->with('success', 'Question deleted successfully.');
    }
}
