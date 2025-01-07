
@extends('layout.main_layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-semibold">Welcome to the Game!</h1>
    <p>Choose a word to begin your journey.</p>
    <div class="grid grid-cols-3 gap-6 mt-8">
        @foreach ($words as $word)
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
            <button class="bg-blue-500 text-white text-center py-2 px-4 rounded hover:bg-blue-600"
                onclick="window.location.href = '{{ route('game.play', ['word_id' => $word->id]) }}'">
                {{ $word->word }}
            </button>
        </div>
        @endforeach
    </div>
</div>
@endsection
