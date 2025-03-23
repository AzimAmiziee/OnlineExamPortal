@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/question.css') }}">

    <div class="container">
        <h1>Manage Questions</h1>

        <!-- Filter Questions by Subject -->
        <form method="GET" action="{{ route('question.manage') }}">
            <div>
                <label for="filter_subject">Filter by Subject:</label>
                <select name="subject_id" id="filter_subject">
                    <option value="">-- All Subjects --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit">Filter</button>
            </div>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif

        <!-- Table listing questions -->
        <h2>Questions List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Subject</th>
                    <th>Type</th>
                    <th>Options / Expected Answer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->id }}</td>
                        <td>{{ $question->question_text }}</td>
                        <td>{{ $question->subject ? $question->subject->name : 'None' }}</td>
                        <td>{{ ucfirst(str_replace('_', ' ', $question->type)) }}</td>
                        <td>
                            @if($question->type === 'multiple_choice')
                                Option 1: {{ $question->option1 }}<br>
                                Option 2: {{ $question->option2 }}<br>
                                Option 3: {{ $question->option3 }}<br>
                                Option 4: {{ $question->option4 }}<br>
                                Correct: Option {{ $question->correct_option }}
                            @else
                                Expected Answer: {{ $question->correct_answer }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('question.edit', $question->id) }}">Edit</a> |
                            <a href="#"
                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this question?')) { document.getElementById('delete-form-{{ $question->id }}').submit(); }">
                                Delete
                            </a>
                            <form id="delete-form-{{ $question->id }}" action="{{ route('question.destroy', $question->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Form to Add a New Question -->
        <h2>Add New Question</h2>
        <form action="{{ route('question.store') }}" method="POST" id="questionForm">
            @csrf
            <div>
                <label for="question_text">Question:</label><br>
                <textarea name="question_text" id="question_text" rows="3" required></textarea>
            </div>
            <div>
                <label for="subject_id">Select Subject:</label><br>
                <select name="subject_id" id="subject_id" required>
                    <option value="">-- Select Subject --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="type">Question Type:</label><br>
                <select name="type" id="type" required onchange="toggleOptions(this.value)">
                    <option value="multiple_choice">Multiple Choice</option>
                    <option value="open_answer">Open Answer</option>
                </select>
            </div>
            <!-- Multiple Choice Fields -->
            <div id="multipleChoiceFields">
                <div>
                    <label for="option1">Option 1:</label><br>
                    <input type="text" name="option1" id="option1" required>
                </div>
                <div>
                    <label for="option2">Option 2:</label><br>
                    <input type="text" name="option2" id="option2" required>
                </div>
                <div>
                    <label for="option3">Option 3:</label><br>
                    <input type="text" name="option3" id="option3" required>
                </div>
                <div>
                    <label for="option4">Option 4:</label><br>
                    <input type="text" name="option4" id="option4" required>
                </div>
                <div>
                    <label for="correct_option">Correct Option (1-4):</label><br>
                    <select name="correct_option" id="correct_option" required>
                        <option value="">-- Select Correct Option --</option>
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                    </select>
                </div>
            </div>
            <!-- Open Answer Field -->
            <div id="openAnswerField" style="display: none;">
                <label for="correct_answer">Expected Answer:</label><br>
                <textarea name="correct_answer" id="correct_answer" rows="2"></textarea>
            </div>
            <button type="submit">Add Question</button>
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