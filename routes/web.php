<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\ClassManagementController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ExamController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:student')->group(function () {
        Route::get('/student/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
        Route::get('/student/result', [StudentController::class, 'result'])->name('student.result');
        Route::get('/exam/take/{subject}', [ExamController::class, 'take'])->name('exam.take');
        Route::post('/exam/submit/{subject}', [ExamController::class, 'submit'])->name('exam.submit');
    });

    Route::middleware('role:lecturer')->group(function () {
        Route::get('/lecturer/dashboard', [LecturerController::class, 'index'])->name('lecturer.dashboard');
        Route::get('/classes', [ClassManagementController::class, 'index'])->name('classes.index');
        Route::post('/classes', [ClassManagementController::class, 'store'])->name('classes.store');
        Route::get('/assign-class', [ClassManagementController::class, 'assign'])->name('classes.assign');
        Route::post('/assign-class', [ClassManagementController::class, 'assignToStudent'])->name('classes.assignToStudent');
    });

    Route::get('/manage-questions', [QuestionController::class, 'index'])->name('question.manage');
    Route::post('/manage-questions', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/manage-questions/{question}/edit', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/manage-questions/{question}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/manage-questions/{question}', [QuestionController::class, 'destroy'])->name('question.destroy');

    Route::get('/manage-subjects', [SubjectController::class, 'index'])->name('subject.manage');
    Route::post('/manage-subjects', [SubjectController::class, 'store'])->name('subject.store');
    Route::get('/manage-subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subject.edit');
    Route::put('/manage-subjects/{subject}', [SubjectController::class, 'update'])->name('subject.update');
    Route::delete('/manage-subjects/{subject}', [SubjectController::class, 'destroy'])->name('subject.destroy');
});

require __DIR__ . '/auth.php';
