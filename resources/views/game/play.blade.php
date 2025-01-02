<!-- resources/views/game/play.blade.php -->

@extends('layout.main_layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-4">Guess the Word!</h1>
    <p class="mb-4">You have <strong>{{ $timeLimit }}</strong> seconds to guess the word.</p>

    <p class="text-2xl mb-6">Word: <strong>{{ $hiddenWord }}</strong></p>

    <form action="{{ route('game.submitGuess') }}" method="POST">
        @csrf
        <input type="text" name="guess" placeholder="Enter your guess" required class="border p-2 rounded">
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Submit</button>
    </form>

    <div class="mt-6">
        <p>Score: <strong>{{ $score }}</strong></p>
        <p>Mistakes Left: <strong>{{ $mistakesLeft }}</strong></p>
    </div>
</div>
@endsection
