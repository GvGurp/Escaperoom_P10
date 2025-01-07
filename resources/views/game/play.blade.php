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
<p class="mb-2">You have <strong>{{ $timeLimit }}</strong> seconds to guess the word!</p>
<p class="mb-2">Mistakes Left: <strong>{{ $mistakesLeft }}</strong></p>
<p>Score: <strong>{{ $score }}</strong></p>

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
</div>



    <!-- Timer Display -->
    <div id="timer" class="text-xl font-bold text-red-600"></div>

    <!-- End Game Button -->
    <div class="mt-4">
        <a href="{{ route('game.end') }}" 
           class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">
            End Game
        </a>
    </div>
</div>

<script>
    // Timer Countdown Logic
    document.addEventListener('DOMContentLoaded', function () {
        let timerElement = document.getElementById('timer');
        let timeRemaining = {{ $timeLimit }};

        // Update the timer every second
        let countdown = setInterval(() => {
            timeRemaining--;
            timerElement.textContent = `Time Left: ${timeRemaining} seconds`;

            if (timeRemaining <= 0) {
                clearInterval(countdown);
                alert("Time's up! Redirecting to the end page...");
                window.location.href = "{{ route('game.end') }}";
            }
        }, 1000);
    });
</script>
@endsection
