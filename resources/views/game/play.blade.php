@extends('layout.main_layout')

@section('content')
<div class="container">
    <div class="bg-gray-100 p-6 rounded-lg shadow-md mb-4">
        <p class="text-xl mb-4">Word: <strong>{{ $hiddenWord }}</strong></p>
        <p class="mb-2">You have <strong id="time-display">{{ $remainingTime }}</strong> seconds to guess the word!</p>
        <p class="mb-2">Mistakes Left: <strong>{{ $mistakesLeft }}</strong></p>
        <p>Score: <strong>{{ $score }}</strong></p>
        <p class="text-lg text-blue-600 mt-4">Hint 1: <strong>{{ $hint1 }}</strong></p>
    </div>

    <form action="{{ route('game.submit-guess') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="guess" class="block text-sm font-medium text-gray-700">Your Guess:</label>
            <input type="text" name="guess" id="guess" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit Guess</button>
    </form>
</div>

<script>
    let timer = document.getElementById('time-display');
    let time = parseInt(timer.textContent);
    let timerInterval = setInterval(function() {
        if (time > 0) {
            time--;
            timer.textContent = time;
        } else {
            clearInterval(timerInterval);
            alert('Time is up! Please try again.');
        }
    }, 1000);
</script>
@endsection
