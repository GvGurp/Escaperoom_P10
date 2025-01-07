@extends('layout.main_layout')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-4">Game Rules</h1>
    <p class="mb-4">Guess as many words as you can within 60 seconds!</p>
    <p class="mb-4">If you make 4 mistakes, the word is skipped. If the little man loses all limbs, the game ends!</p>
    <form action="{{ route('game.start') }}" method="GET">
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Start Game
        </button>
    </form>
</div>
@endsection
