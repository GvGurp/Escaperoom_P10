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
            <p class="mb-2">You have <strong id="time-display"></strong> seconds to guess the word!</p>
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

    <!-- Buttons -->
    <div class="mt-4">
        <button id="start-game-btn" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">
            Start Game
        </button>
        <a id="end-game-btn" href="{{ route('game.end') }}" 
           class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
            End Game
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const timerElement = document.getElementById('time-display');
        const endGameButton = document.getElementById('end-game-btn');

        // Retrieve time from localStorage or use the server-rendered remainingTime
        let timeRemaining = localStorage.getItem('timeRemaining') 
            ? parseInt(localStorage.getItem('timeRemaining'), 10) 
            : {{ $remainingTime }};
        let countdown;

        // Display the correct initial time
        timerElement.textContent = timeRemaining;

        // Function to start the timer
        function startTimer() {
            countdown = setInterval(() => {
                timeRemaining--;
                timerElement.textContent = timeRemaining;

                // Update localStorage to persist time
                localStorage.setItem('timeRemaining', timeRemaining);

                if (timeRemaining <= 0) {
                    clearInterval(countdown);
                    localStorage.removeItem('timeRemaining'); // Clear time on game end
                    alert("Time's up! Redirecting to the end page...");
                    window.location.href = "{{ route('game.end') }}";
                }
            }, 1000);
        }

        // Start the timer automatically
        startTimer();

        // Stop the timer and clear localStorage when the end game button is clicked
        endGameButton.addEventListener('click', () => {
            clearInterval(countdown);
            localStorage.removeItem('timeRemaining');
        });
    });
</script>
@endsection
