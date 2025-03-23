@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-bold mb-4">👨‍🏫 Assign Students to Class</h2>

    <!-- Display success message if available -->
    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table showing current student-class assignments -->
    <h3 class="text-lg font-semibold mb-2">Students Class</h3>
    <div class="table-container">
        <table class="assign-table">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>
                            {{ $student->name }} ({{ $student->email }})
                        </td>
                        <td>
                            @if($student->studentClass)
                                {{ $student->studentClass->name }}
                            @else
                                <span class="text-gray-500">None</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Form to assign a student to a class -->
    <form action="{{ route('classes.assignToStudent') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="student_id" class="block font-medium text-sm text-gray-700">Select Student</label>
            <select name="student_id" id="student_id" class="w-full border rounded px-4 py-2" required>
                <option value="">-- Choose a Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="class_id" class="block font-medium text-sm text-gray-700">Assign to Class</label>
            <select name="class_id" id="class_id" class="w-full border rounded px-4 py-2" required>
                <option value="">-- Choose a Class --</option>
                @if($studentClasses->isNotEmpty())
                    @foreach($studentClasses as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                @else
                    <option value="">No classes available</option>
                @endif
            </select>
        </div>

        <button type="submit" class="text-black border border-black px-4 py-2 rounded hover:bg-gray-100">
            Assign
        </button>
    </form>
</div>
@endsection
