@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">

    <div class="container">
        <h1>Edit Question</h1>

        <!-- Display validation errors if any -->
        @if($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('question.update', $question->id) }}" method="POST" id="questionEditForm">
            @csrf
            @method('PUT')
            <div>
                <label for="question_text">Question:</label><br>
                <textarea name="question_text" id="question_text" rows="3"
                    required>{{ $question->question_text }}</textarea>
            </div>
            <div>
                <label for="subject_id">Select Subject:</label><br>
                <select name="subject_id" id="subject_id" required>
                    <option value="">-- Select Subject --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $question->subject_id == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="type">Question Type:</label><br>
                <select name="type" id="type" required onchange="toggleOptions(this.value)">
                    <option value="multiple_choice" {{ $question->type === 'multiple_choice' ? 'selected' : '' }}>Multiple
                        Choice</option>
                    <option value="open_answer" {{ $question->type === 'open_answer' ? 'selected' : '' }}>Open Answer</option>
                </select>
            </div>
            <!-- Multiple Choice Fields -->
            <div id="multipleChoiceFields" style="display: none;">
                <div>
                    <label for="option1">Option 1:</label><br>
                    <input type="text" name="option1" id="option1" value="{{ $question->option1 }}">
                </div>
                <div>
                    <label for="option2">Option 2:</label><br>
                    <input type="text" name="option2" id="option2" value="{{ $question->option2 }}">
                </div>
                <div>
                    <label for="option3">Option 3:</label><br>
                    <input type="text" name="option3" id="option3" value="{{ $question->option3 }}">
                </div>
                <div>
                    <label for="option4">Option 4:</label><br>
                    <input type="text" name="option4" id="option4" value="{{ $question->option4 }}">
                </div>
                <div>
                    <label for="correct_option">Correct Option (1-4):</label><br>
                    <select name="correct_option" id="correct_option">
                        <option value="">-- Select Correct Option --</option>
                        <option value="1" {{ $question->correct_option == 1 ? 'selected' : '' }}>Option 1</option>
                        <option value="2" {{ $question->correct_option == 2 ? 'selected' : '' }}>Option 2</option>
                        <option value="3" {{ $question->correct_option == 3 ? 'selected' : '' }}>Option 3</option>
                        <option value="4" {{ $question->correct_option == 4 ? 'selected' : '' }}>Option 4</option>
                    </select>
                </div>
            </div>
            <!-- Open Answer Field -->
            <div id="openAnswerField" style="display: none;">
                <label for="correct_answer">Expected Answer:</label><br>
                <textarea name="correct_answer" id="correct_answer" rows="2">{{ $question->correct_answer }}</textarea>
            </div>
            <button type="submit">Update Question</button>
        </form>
    </div>

    <script>
        function toggleOptions(type) {
            if (type === 'multiple_choice') {
                document.getElementById('multipleChoiceFields').style.display = 'block';
                document.getElementById('openAnswerField').style.display = 'none';
                // Set required attributes for multiple choice fields
                document.getElementById('option1').required = true;
                document.getElementById('option2').required = true;
                document.getElementById('option3').required = true;
                document.getElementById('option4').required = true;
                document.getElementById('correct_option').required = true;
            } else {
                document.getElementById('multipleChoiceFields').style.display = 'none';
                document.getElementById('openAnswerField').style.display = 'block';
                // Remove required attributes from multiple choice fields
                document.getElementById('option1').required = false;
                document.getElementById('option2').required = false;
                document.getElementById('option3').required = false;
                document.getElementById('option4').required = false;
                document.getElementById('correct_option').required = false;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleOptions(document.getElementById('type').value);
        });
    </script>
@endsection