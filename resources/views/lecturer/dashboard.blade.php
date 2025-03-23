@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-card text-center">
        <!-- Welcome Text -->
        <h1 class="welcome-title">Welcome Lecture, {{ Auth::user()->name }}</h1>

        <!-- Big Centered Icon -->
        <div class="dashboard-icon">
            <!-- You can change this to a people/teacher icon if you like -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.66 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0zM19.5 7h.008v.008H19.5V7z" />
            </svg>
        </div>

        <!-- Dashboard Buttons -->
        <div class="dashboard-buttons">
            <a href="{{ route('subject.manage') }}" class="subject">Manage Subject</a>
            <a href="{{ route('question.manage') }}" class="question">Manage Question</a>
        </div>
    </div>
</div>
@endsection
