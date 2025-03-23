@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/subject.css') }}">

    <div class="container">
        <h1>Manage Subjects</h1>

        <!-- Success Message -->
        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <!-- Form to add a new subject -->
        <h2>Add New Subject</h2>
        <form action="{{ route('subject.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">Subject Name:</label>
                <input type="text" name="name" id="name" required>
            </div>
            <div>
                <label for="duration">Exam Duration (minutes):</label>
                <input type="number" name="duration" id="duration" min="0" placeholder="Enter duration (optional)">
            </div>
            <div>
                <label for="student_class_ids">Select Classes:</label>
                <select name="student_class_ids[]" id="student_class_ids" required multiple>
                    @foreach($studentClasses as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                <small>Hold down the Ctrl (Windows) or Command (Mac) button to select multiple options.</small>
            </div>
            <button type="submit">Add Subject</button>
        </form>

        <!-- Table listing subjects -->
        <h2>Subjects List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Subject Name</th>
                    <th>Duration (min)</th>
                    <th>Classes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->duration ?? 'N/A' }}</td>
                        <td>
                            @if($subject->studentClasses->isNotEmpty())
                                {{ $subject->studentClasses->pluck('name')->join(', ') }}
                            @else
                                None
                            @endif
                        </td>
                        <td class="table-actions">
                            <a href="{{ route('subject.edit', $subject->id) }}">Edit</a> |
                            <a href="#" class="delete"
                                onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this subject?')) { document.getElementById('delete-form-{{ $subject->id }}').submit(); }">Delete</a>
                            <form id="delete-form-{{ $subject->id }}" action="{{ route('subject.destroy', $subject->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection