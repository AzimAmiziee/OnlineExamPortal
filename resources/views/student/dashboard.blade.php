@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/student.css') }}">

    <div class="dashboard-container">
        <div class="dashboard-card text-center">
            <!-- Welcome Text -->
            <h1 class="welcome-title">Welcome Student, {{ Auth::user()->name }}</h1>

            <!-- Big Centered Icon -->
            <div class="dashboard-icon">
                <!-- Replace with an icon/image of your choice -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.66 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0zM19.5 7h.008v.008H19.5V7z" />
                </svg>
            </div>

            <!-- Student Class -->
            <h2 class="student-class">
                Student Class: {{ Auth::user()->studentClass ? Auth::user()->studentClass->name : 'Not Assigned' }}
            </h2>
        </div>

        <!-- Available Subjects for Exam -->
        <div class="subjects-container">
            <h2>Available Subjects for Exam</h2>
            <table class="subjects-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Duration (minutes)</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->duration }} minutes</td>
                            <td>
                                @if(Auth::user()->results->where('subject_id', $subject->id)->count() > 0)
                                    <button class="btn btn-disabled" disabled>Exam Taken</button>
                                @else
                                    <a href="{{ route('exam.take', $subject->id) }}" class="btn btn-primary">Take Exam</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    @if(session('submitted_subject_id'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const subjectId = "{{ session('submitted_subject_id') }}";
                localStorage.removeItem("exam_end_time_" + subjectId);
                localStorage.removeItem("started_exam_" + subjectId); // in case you used this key
                console.log("LocalStorage for exam " + subjectId + " cleared.");
            });
        </script>
    @endif

@endsection