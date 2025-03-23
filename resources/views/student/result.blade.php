@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/student.css') }}">

    <div class="container">
        <h1>My Exam Results</h1>

        @if(isset($results) && $results->count())
            <table class="results-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Score</th>
                        <th>Exam Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->id }}</td>
                            <td>{{ $result->subject ? $result->subject->name : 'N/A' }}</td>
                            <td>{{ $result->score }}%</td>
                            <td>{{ \Carbon\Carbon::parse($result->exam_date)->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-results">No results found.</p>
        @endif
    </div>
@endsection