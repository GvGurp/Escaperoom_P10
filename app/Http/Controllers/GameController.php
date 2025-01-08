<?php


namespace App\Http\Controllers;

use App\Models\WordCode;
use App\Models\UserProgress;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GameController extends Controller
{
    // Display the rules before the game starts
    public function startGame()
    {
        // Reset score to 0 when starting a new game
        $user = Auth::user();
        UserProgress::updateOrCreate(
            ['user_id' => $user->id, 'level_id' => 1], // Assuming level 1
            ['score' => 0, 'completed' => false, 'mistakes' => 0] // Reset score and mistakes
        );

        return view('game.play', [
            'hiddenWord' => '_ _ _ _ _', // Replace with actual logic
            'timeLimit' => 60,
            'score' => 0,
            'mistakesLeft' => 5,
        ]);
    }

    public function playGame(Request $request)
{
    $user = Auth::user();

    // Fetch a random word if no word_id is provided
    $wordcode = $request->word_id 
        ? WordCode::find($request->word_id)
        : WordCode::inRandomOrder()->first();

    if (!$wordcode) {
        return redirect()->back()->with('error', 'No word available to guess. Please add some words to the database.');
    }

    $progress = UserProgress::firstOrCreate(
        ['user_id' => $user->id, 'level_id' => 1],
        ['score' => 0, 'completed' => false, 'mistakes' => 0, 'start_time' => now()]
    );

    // Calculate remaining time
    $startTime = $progress->start_time ?? now();
    $timeElapsed = now()->diffInSeconds($startTime);
    $timeLimit = 60;
    $remainingTime = max(0, $timeLimit - $timeElapsed);

    return view('game.play', [
        'word' => $wordcode,
        'hiddenWord' => str_repeat('_ ', strlen($wordcode->word)),
        'remainingTime' => $remainingTime, // Pass the remaining time
        'score' => $progress->score,
        'mistakesLeft' => 5 - ($progress->mistakes ?? 0),
        'hint1' => $wordcode->hint1,
    ]);
}


    public function submitGuess(Request $request)
{
    $user = Auth::user();
    $progress = UserProgress::where('user_id', $user->id)->first();
    $word = WordCode::find($request->word_id);

    // Check if the word exists
    if (!$word) {
        return redirect()->route('game.play')->with('error', 'Word not found.');
    }

    $currentScore = $progress->score ?? 0;
    $guess = trim($request->guess); // Trim input

    // Handle empty guess
    if (empty($guess)) {
        return redirect()->back()->with('error', 'Please enter a guess before submitting.');
    }

    // If the guess is correct
    if (strcasecmp($word->word, $guess) === 0) {
        $progress->score += 250; // Add points
        $progress->save();

        // Fetch the next word
        $nextWord = WordCode::where('id', '!=', $word->id)->inRandomOrder()->first();

        // If no more words are available, end the game
        if (!$nextWord) {
            return redirect()->route('game.end')->with('success', 'Congratulations! You completed all the words.');
        }

        // Redirect to the next word without resetting the timer or mistakes
        return redirect()->route('game.play', [
            'word_id' => $nextWord->id,
        ])->with('success', 'Correct! Moving to the next word.');
    } else {
        // If the guess is incorrect, increment mistakes
        $progress->mistakes = ($progress->mistakes ?? 0) + 1;

        // Check if the user has reached the max mistakes
        if ($progress->mistakes >= 5) {
            return redirect()->route('game.start')->with('error', 'Game over! You have reached the maximum number of mistakes.');
        }

        // Deduct points but ensure the score doesn't go below 0
        $progress->score = max(0, $currentScore - 50);
        $progress->save();

        // Redirect back to the same word
        return redirect()->route('game.play', ['word_id' => $word->id])
            ->with('error', 'Incorrect guess. Try again!');
    }
}


    public function endGame(Request $request)
    {
        $user = Auth::user();
        $progress = UserProgress::where('user_id', $user->id)->first();
        $progress->completed = true;

        Score::create([
            'user_id' => $user->id,
            'score' => $progress->score,
        ]);

        return redirect()->route('game.start');
    }
}
