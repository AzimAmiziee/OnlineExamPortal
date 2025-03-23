@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/exam.css') }}">

    <div class="container">
        <h1>Exam: {{ $subject->name }}</h1>
        <form id="examForm" action="{{ route('exam.submit', $subject->id) }}" method="POST">
            @csrf
            @foreach($subject->questions as $index => $question)
                <div class="question-block">
                    <p><strong>Q{{ $index + 1 }}: {{ $question->question_text }}</strong></p>
                    @if($question->type === 'multiple_choice')
                        <div class="options">
                            <label><input type="radio" name="answer[{{ $question->id }}]" value="1"> Option 1:
                                {{ $question->option1 }}</label><br>
                            <label><input type="radio" name="answer[{{ $question->id }}]" value="2"> Option 2:
                                {{ $question->option2 }}</label><br>
                            <label><input type="radio" name="answer[{{ $question->id }}]" value="3"> Option 3:
                                {{ $question->option3 }}</label><br>
                            <label><input type="radio" name="answer[{{ $question->id }}]" value="4"> Option 4:
                                {{ $question->option4 }}</label>
                        </div>
                    @else
                        <div class="open-answer">
                            <label for="answer_{{ $question->id }}">Your Answer:</label><br>
                            <textarea name="answer[{{ $question->id }}]" id="answer_{{ $question->id }}" rows="2"></textarea>
                        </div>
                    @endif
                </div>
                <hr>
            @endforeach
            <button type="submit" class="btn btn-primary">Submit Exam</button>
        </form>
    </div>

    <!-- Timer -->
    <div id="timer" class="exam-timer">Loading timer...</div>

    <script>
        const subjectId = {{ $subject->id }};
        const durationMinutes = {{ $subject->duration }};
        const examForm = document.getElementById("examForm");
        const timerEl = document.getElementById("timer");
        const storageKey = `exam_end_time_${subjectId}`;
        let isSubmitting = false;

        // Set or retrieve end time from localStorage
        let endTime = localStorage.getItem(storageKey);
        if (!endTime) {
            const now = new Date().getTime();
            endTime = now + durationMinutes * 60 * 1000;
            localStorage.setItem(storageKey, endTime);
        } else {
            endTime = parseInt(endTime);
        }

        function updateTimer() {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance <= 0) {
                timerEl.innerHTML = "Time's up!";
                clearInterval(timerInterval);
                localStorage.removeItem(storageKey); // Clear storage
                isSubmitting = true;
                examForm.submit(); // Auto-submit
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            timerEl.innerHTML = `${minutes}m ${seconds}s remaining`;
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // Confirm before submitting manually
        examForm.addEventListener("submit", function (e) {
            if (!isSubmitting) {
                const confirmSubmit = confirm("Are you sure you want to submit this?");
                if (!confirmSubmit) {
                    e.preventDefault();
                } else {
                    isSubmitting = true;
                }
            }
        });

        // Prevent refresh or tab close
        window.addEventListener("beforeunload", function (e) {
            if (!isSubmitting) {
                e.preventDefault();
                e.returnValue = "";
            }
        });

        // Prevent clicking on links (navbar, etc.)
        document.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", function (e) {
                if (!isSubmitting) {
                    e.preventDefault();
                    alert("You cannot leave the exam while it's in progress.");
                }
            });
        });
    </script>

@endsection