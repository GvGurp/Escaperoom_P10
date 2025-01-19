@extends('layout.main_layout')

@section('content')
<div class="container bg-dark-blue min-h-screen flex items-center justify-center text-white">
    <div class="w-full max-w-lg p-8 bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Word Guessing Game</h2>

        <!-- Display Remaining Time -->
        <div class="flex justify-between mt-4">
            <h4 class="text-lg">Remaining Time: <span id="timer">60</span> seconds</h4>
            <h4 class="text-lg">Score: <span id="score">{{ session('score', 0) }}</span></h4>
        </div>

        <!-- Display Word Blanks -->
        <div class="mt-8 text-center">
            <h3 id="word-blanks" class="text-3xl font-bold">{{ $gameData['blanks'] }}</h3>
        </div>

        <!-- Hint Display -->
        <div class="mt-6">
            <p><strong class="text-lg">Hint:</strong> <span id="hint1">{{ $gameData['hint1'] }}</span></p>
            <p id="hint2" class="mt-3 text-lg {{ empty($gameData['hint2']) ? 'hidden' : '' }}"><strong>Hint 2:</strong> <span>{{ $gameData['hint2'] }}</span></p>
        </div>

        <!-- Feedback -->
        @if(isset($feedback))
            <div class="mt-4 bg-gray-700 p-4 rounded-lg text-white">
                <p>{{ $feedback }}</p>
            </div>
        @endif

        <form action="{{ route('game.checkAnswer') }}" method="POST">
            @csrf
            <input type="text" name="guess" id="guess" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your guess">
            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition duration-300 mt-4">Submit</button>
        </form>

        <!-- Game End Popup -->
        <div id="game-end-popup" class="hidden mt-6 p-8 bg-gray-700 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold text-center mb-4">Game Over!</h3>
            <p class="text-center text-lg">Final Score: <span id="final-score">{{ session('score', 0) }}</span></p>
            <div class="flex justify-center mt-6 space-x-4">
                <a href="{{ route('game.index') }}" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">Try Again</a>
                <a href="{{ route('next-game') }}" class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300">Next Game</a>
            </div>
        </div>
    </div>
</div>
@endsection
