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
        $words = WordCode::get(['id', 'word']);  // Ensure you specify the columns you need

        return view('game.start', compact('words'));
    }

    

    // Start the actual game
    public function playGame(Request $request)
    {
        $user = Auth::user();
        $word = WordCode::find($request->word_id); // Get the word based on word_id
        $timeLimit = 60; // 60 seconds for the game
        $startTime = Carbon::now();
        $endTime = $startTime->addSeconds($timeLimit);
    
        // Save the user progress for this level
        $progress = UserProgress::create([
            'user_id' => $user->id,
            'level_id' => 1, // Assuming this is the first level
            'score' => 0,
            'completed' => false,
        ]);
    
        return view('game.play', [
            'word' => $word,
            'timeLimit' => $timeLimit,
            'startTime' => $startTime,
            'endTime' => $endTime
        ]);
    }
    
    // Handle the user's guess input
    public function submitGuess(Request $request)
    {
        $user = Auth::user();
        $progress = UserProgress::where('user_id', $user->id)->first();
        $word = WordCode::find($request->word_id);

        $currentScore = $progress->score;
        $guess = $request->guess;

        // Check if the guess is correct
        if (stripos($word->word, $guess) !== false) {
            $progress->score += 250; // Correct guess
        } else {
            // Deduct points for wrong guesses
            $mistakes = $progress->mistakes ?? 0;
            $mistakes++;

            if ($mistakes === 4) {
                // Skip word if 4 mistakes
                $progress->mistakes = 0;
                // Move to the next word logic here
            } else {
                $progress->mistakes = $mistakes;
                $deductPoints = [0, 20, 50, 150];
                $progress->score = max(0, $progress->score - $deductPoints[$mistakes]);
            }
        }

        $progress->save();

        return redirect()->route('game.play', ['word_id' => $word->id]);
    }

    // End the game and save the score
    public function endGame(Request $request)
    {
        $user = Auth::user();
        $progress = UserProgress::where('user_id', $user->id)->first();
        $progress->completed = true;
        $progress->save();

        // Calculate the total score
        Score::create([
            'user_id' => $user->id,
            'level_id' => 1,
            'score' => $progress->score,
            'time_taken' => Carbon::now()->diffInSeconds($progress->created_at),
        ]);

        return view('game.end', [
            'score' => $progress->score,
            'timeTaken' => Carbon::now()->diffInSeconds($progress->created_at)
        ]);
    }

    // Go to next level (level 2)
    public function nextLevel()
    {
        // Check if the user has completed the current level and then go to the next one
        return redirect()->route('game.start'); // Redirect to level 2 or next game section
    }

    // Restart the game (reset the score, etc.)
    public function restartGame()
    {
        return redirect()->route('game.start'); // Reset game to the start
    }
}
