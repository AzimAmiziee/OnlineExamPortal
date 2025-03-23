<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function take($subjectId)
    {
        if (!Auth::check()) {
            \Log::error('User is NOT authenticated at /exam/take');
            abort(403, 'You are not logged in');
        }

        $subject = Subject::with('questions')->findOrFail($subjectId);

        $existingResult = Auth::user()->results()->where('subject_id', $subjectId)->first();
        if ($existingResult) {
            return redirect()->route('student.dashboard')
                ->with('success', 'You have already taken this exam.');
        }

        return view('student.exam.take', compact('subject'));
    }



    public function submit(Request $request, $subjectId)
    {
        $subject = Subject::with('questions')->findOrFail($subjectId);
        $questions = $subject->questions;

        $totalQuestions = count($questions);
        $correctCount = 0;

        foreach ($questions as $question) {
            $userAnswer = $request->input("answer.{$question->id}");

            if ($question->type === 'multiple_choice') {
                // Ensure we compare integers. Also check if userAnswer is not null.
                if (!is_null($userAnswer) && (int) $userAnswer === (int) $question->correct_option) {
                    $correctCount++;
                }
            } else {
                // For open answer questions, use case-insensitive comparison.
                if ($userAnswer && strtolower(trim($userAnswer)) === strtolower(trim($question->correct_answer))) {
                    $correctCount++;
                }
            }
        }

        $scorePercentage = $totalQuestions > 0 ? ($correctCount / $totalQuestions) * 100 : 0;

        if ($scorePercentage >= 90) {
            $grade = 'A';
        } elseif ($scorePercentage >= 80) {
            $grade = 'B';
        } elseif ($scorePercentage >= 70) {
            $grade = 'C';
        } elseif ($scorePercentage >= 60) {
            $grade = 'D';
        } else {
            $grade = 'F';
        }

        Result::create([
            'student_id' => Auth::id(),
            'subject_id' => $subject->id,
            'score' => $scorePercentage,
            'grade' => $grade,
            'exam_date' => now(),
        ]);

        return redirect()->route('student.dashboard')
            ->with([
                'success' => 'Exam submitted successfully...',
                'submitted_subject_id' => $subject->id, // 👈 you pass this in
            ]);


    }

}
