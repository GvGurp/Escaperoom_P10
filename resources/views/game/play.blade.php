@extends('layout.main_layout')

@section('content')
<div class="container mx-auto p-6">
    <!-- Title -->
    <h1 class="text-4xl font-bold mb-4">Guess the Word!</h1>

    <!-- Display Error Message -->
    @if(session('error'))
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <!-- Game Details -->
    @if(isset($word))
        <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-4">
            <p class="text-xl mb-4">Word: <strong>{{ $hiddenWord }}</strong></p>
            <p class="mb-2">You have <strong id="time-display">{{ $timeLimit }}</strong> seconds to guess the word!</p>
            <p class="mb-2">Mistakes Left: <strong>{{ $mistakesLeft }}</strong></p>
            <p>Score: <strong>{{ $score }}</strong></p>

             <!-- Display First Hint -->
             <p class="text-lg text-blue-600 mt-4">Hint 1: <strong>{{ $hint1 }}</strong></p>
        </div>

        <!-- Guess Form -->
        <form action="{{ route('game.submit-guess') }}" method="POST">
            @csrf
            <input type="hidden" name="word_id" value="{{ $word->id }}">
            <input type="text" name="guess" placeholder="Enter your guess" class="border rounded px-4 py-2">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Submit Guess
            </button>
        </form>
    @else
        <p>No word available to guess. Please add some words to the database.</p>
    @endif

    <!-- Timer Display -->
    <div id="timer" class="text-xl font-bold text-red-600"></div>

    <!-- Start Game Button -->
    <div class="mt-4">
        <button id="start-game-btn" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
            Start Game
        </button>
        <a href="{{ route('game.end') }}" 
           class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
            End Game
        </a>
    </div>
</div>

<script>
    // Timer Logic
    document.addEventListener('DOMContentLoaded', function () {
        const timerElement = document.getElementById('time-display');
        const startButton = document.getElementById('start-game-btn');
        let timeRemaining = {{ $timeLimit }};
        let countdown;

        // Start the timer
        function startTimer() {
            startButton.style.display = 'none'; // Hide the start button
            countdown = setInterval(() => {
                timeRemaining--;
                timerElement.textContent = timeRemaining;

                if (timeRemaining <= 0) {
                    clearInterval(countdown);
                    alert("Time's up! Redirecting to the end page...");
                    window.location.href = "{{ route('game.end') }}";
                }
            }, 1000);
        }

        // Event listener for the start button
        startButton.addEventListener('click', () => {
            startTimer();
        });
    });
</script>
@endsection
