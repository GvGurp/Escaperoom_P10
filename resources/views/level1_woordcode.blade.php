@extends('layout.main_layout') <!-- Extend the main layout (Gaby) -->

@section('content') <!-- Define the content section (Gaby) -->
<div class="container mx-auto p-6">
    <!-- Title -->
    <h1 class="text-4xl font-bold mb-4">Guess the Word!</h1> <!-- Page Title (Gaby) -->

    <!-- Display Error Message -->
    @if(session('error'))
        <div class="bg-red-500 text-white p-4 mb-4 rounded">
            {{ session('error') }} <!-- Display error message if exists (Gaby) -->
        </div>
    @endif

    <!-- Game Details -->
    @if(isset($word))
        <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-4">
            <p class="text-xl mb-4">Word: <strong>{{ $hiddenWord }}</strong></p> <!-- Display hidden word (Gaby) -->
            <p class="mb-2">You have <strong id="time-display">{{ $remainingTime }}</strong> seconds to guess the word!</p> <!-- Timer display (Gaby) -->
            <p class="mb-2">Mistakes Left: <strong>{{ $mistakesLeft }}</strong></p> <!-- Remaining mistakes (Gaby) -->
            <p>Score: <strong>{{ $score }}</strong></p> <!-- Display score (Gaby) -->
            <p class="text-lg text-blue-600 mt-4">Hint 1: <strong>{{ $hint1 }}</strong></p> <!-- Display hint (Gaby) -->
        </div>

        <!-- Guess Form -->
        <form action="{{ route('game.submit-guess') }}" method="POST">
            @csrf <!-- CSRF Token for security (Gaby) -->
            <input type="hidden" name="word_id" value="{{ $word->id }}"> <!-- Pass word ID to the server (Gaby) -->
            <input type="text" name="guess" placeholder="Enter your guess" class="border rounded px-4 py-2"> <!-- Input for the guess (Gaby) -->
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Submit Guess <!-- Button to submit the guess (Gaby) -->
            </button>
        </form>
    @else
        <p>No word available to guess. Please add some words to the database.</p> <!-- Fallback message (Gaby) -->
    @endif

    <!-- Timer Display -->
    <div id="timer" class="text-xl font-bold text-red-600"></div> <!-- Timer element (Gaby) -->

    <!-- Start and End Game Buttons -->
    <div class="mt-4">
        <a href="{{ route('game.end') }}" 
           id="end-game-btn"
           class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
            End Game <!-- Button to end the game (Gaby) -->
        </a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () { 
        const timerElement = document.getElementById('time-display'); // Timer element reference (Gaby)
        const endGameButton = document.getElementById('end-game-btn'); // End game button reference (Gaby)
        let timeRemaining = {{ $remainingTime }}; // Get remaining time from server (Gaby)
        let countdown; // Variable to store countdown interval (Gaby)

        // Function to start or resume the timer (Gaby)
        function startTimer() {
            countdown = setInterval(() => {
                timeRemaining--; // Decrement remaining time (Gaby)
                timerElement.textContent = timeRemaining; // Update the timer display (Gaby)

                // Update the database with the current remaining time (Gaby)
                fetch('{{ route('game.update-time') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security (Gaby)
                        'Content-Type': 'application/json', // Set content type to JSON (Gaby)
                    },
                    body: JSON.stringify({ remaining_time: timeRemaining }), // Send remaining time to server (Gaby)
                });

                if (timeRemaining <= 0) { // Check if time is up (Gaby)
                    clearInterval(countdown); // Clear the countdown (Gaby)
                    alert("Time's up! Redirecting to the end page..."); // Alert the user (Gaby)
                    window.location.href = "{{ route('game.end') }}"; // Redirect to end game page (Gaby)
                }
            }, 1000); // Update every second (Gaby)
        }

        // Start or resume the timer on page load (Gaby)
        startTimer();

        // Stop the timer when the end game button is clicked (Gaby)
        endGameButton.addEventListener('click', () => {
            clearInterval(countdown); // Stop the countdown timer (Gaby)
        });
    });
</script>
@endsection
