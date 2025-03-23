@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-bold mb-4">📚 My Classes</h2>

    @if(session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('classes.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex items-center gap-4">
            <input type="text" name="name" class="border rounded px-4 py-2 w-full" placeholder="Enter new class name" required>
            <button type="submit" class="text-black border border-black px-4 py-2 rounded hover:bg-gray-100">
                Create
            </button>
        </div>
    </form>

    <div>
        <h3 class="text-lg font-semibold mb-2">Existing Classes:</h3>
        @if($studentClasses->count())
            <ul class="list-disc list-inside">
                @foreach($studentClasses as $class)
                    <li>{{ $class->name }} <span class="text-gray-500 text-sm">(ID: {{ $class->id }})</span></li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No classes created yet.</p>
        @endif
    </div>
</div>
@endsection
