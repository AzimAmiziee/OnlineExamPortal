@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/subject.css') }}">

    <div class="container">
        <h1>Edit Subject</h1>

        <!-- Display validation errors if any -->
        @if($errors->any())
            <div style="color:red; margin-bottom: 15px;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('subject.update', $subject->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Subject Name:</label>
                <input type="text" name="name" id="name" value="{{ $subject->name }}" required>
            </div>
            <div>
                <label for="duration">Exam Duration (minutes):</label>
                <input type="number" name="duration" id="duration" min="0" value="{{ $subject->duration }}">
            </div>
            <div>
                <label for="student_class_ids">Select Classes:</label>
                <select name="student_class_ids[]" id="student_class_ids" required multiple>
                    @foreach($studentClasses as $class)
                        <option value="{{ $class->id }}" {{ $subject->studentClasses->contains($class->id) ? 'selected' : '' }}>
                            {{ $class->name }}
                        </option>
                    @endforeach
                </select>
                <small>Hold down the Ctrl (Windows) or Command (Mac) button to select multiple options.</small>
            </div>
            <button type="submit">Update Subject</button>
        </form>
    </div>
@endsection