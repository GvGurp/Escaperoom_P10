@extends('layout.main_layout')

@section('content')
<div class="container bg-dark-blue min-h-screen flex items-center justify-center text-white">
    <div class="w-full max-w-lg p-8 bg-gray-800 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Word Guessing Game</h2>

        <!-- Display Remaining Time -->
        <div class="flex justify-between mt-4">
            <h4 class="text-lg">Remaining Time: <span id="timer">{{ $timer }}</span> seconds</h4>
            <h4 class="text-lg">Score: <span id="score">{{ session('score', 0) }}</span></h4>
        </div>

        <!-- Display Word Blanks -->
        <div class="mt-8 text-center">
            <h3 id="word-blanks" class="text-3xl font-bold">{{ $gameData['blanks'] }}</h3>
        </div>

        <!-- Hint Display -->
        <div>
            <p>Hint 1: {{ $gameData['hint1'] }}</p>
            @if ($gameData['showHint2'])
                <p>Hint 2: {{ $gameData['hint2'] }}</p>
            @endif
        </div>

        <!-- Feedback -->
        @if(session('message'))
            <div class="mt-4 bg-gray-700 p-4 rounded-lg text-white">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <!-- Guess Form -->
        <form action="{{ route('game.checkAnswer') }}" method="POST" id="guess-form">
            @csrf
            <input type="hidden" name="remainingTime" id="remaining-time" value="{{ $timer }}">
            <input type="text" name="guess" id="guess" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your guess">
            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition duration-300 mt-4">Submit</button>
        </form>
    </div>
</div>

<!-- Timer Script -->
<script>
    let timer = {{ $timer }}; // Get the remaining time from the server
    const timerElement = document.getElementById('timer');
    const remainingTimeInput = document.getElementById('remaining-time');

    const countdown = setInterval(() => {
        if (timer > 0) {
            timer--;
            timerElement.textContent = timer;
            remainingTimeInput.value = timer; // Update the hidden input with the remaining time
        } else {
            clearInterval(countdown); // Stop the timer
            timerElement.textContent = "0";
            alert("Time's up! The game is over.");
            document.getElementById('guess-form').submit(); // Optionally submit the form or handle game over logic
        }
    }, 1000); // Decrease timer every 1 second
</script>
@endsection
