<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordCode;

class GameController extends Controller
{

    public function index()
    {
        $words = WordCode::all();

        if ($words->isEmpty()) {
            return redirect('/')->with('error', 'No words available for the game!');
        }

        // Start the game by initializing the session
        session(['currentIndex' => 0, 'score' => 0, 'showHint2' => false, 'remainingTime' => 60]);

        // Redirect to the next word (which begins the game)
        return redirect()->route('game.nextWord');
    }
    public function nextWord()
    {
        $words = WordCode::all();

        if ($words->isEmpty()) {
            return redirect('/')->with('error', 'No words available for the game!');
        }

        // Get the current index from the session
        $currentIndex = session('currentIndex', 0);

        // Check if we've reached the end of the words list
        if ($currentIndex >= $words->count()) {
            return redirect('/')->with('message', 'Game over! Thanks for playing.');
        }

        // Get the current word
        $currentWord = $words[$currentIndex];

        // Prepare game data
        $gameData = [
            'blanks' => str_repeat('-', strlen($currentWord->word)),
            'hint1' => $currentWord->hint1,
            'hint2' => $currentWord->hint2,
            'showHint2' => session('showHint2', false), // Track if Hint 2 should be shown
        ];

        // Pass the timer value from the session or default to 60 seconds
        $remainingTime = session('remainingTime', 60);

        return view('level1_woordcode', [
            'score' => session('score', 0),
            'gameData' => $gameData,
            'timer' => $remainingTime,
        ]);
    }

    public function checkAnswer(Request $request)
    {
        $guess = strtolower(trim($request->input('guess')));
        $words = WordCode::all();

        if ($words->isEmpty()) {
            return redirect('/')->with('error', 'No words available for the game!');
        }

        // Get the current index and word
        $currentIndex = session('currentIndex', 0);
        $currentWord = $words[$currentIndex];

        // Persist the remaining time from the request
        $remainingTime = $request->input('remainingTime', 60);
        session(['remainingTime' => $remainingTime]);

        // Check if the guess is correct
        if ($guess === strtolower($currentWord->word)) {
            // Correct answer
            session(['score' => session('score', 0) + 100]); // Add 100 points
            session(['currentIndex' => $currentIndex + 1]); // Move to the next word
            session(['showHint2' => false]); // Reset hint 2 visibility
            return redirect()->route('game.nextWord')->with('message', 'Correct! You earned 100 points.');
        } else {
            // Incorrect answer
            session(['score' => session('score', 0) - 50]); // Deduct 50 points
            session(['showHint2' => true]); // Enable hint 2 visibility
            return redirect()->route('game.nextWord')->with('message', 'Incorrect! You lost 50 points.');
        }
    }

    public function endGame()
    {
        $score = session('score', 0); // Get the player's score
        return view('game_end', ['score' => $score]); // Pass the score to the game_end view
    }
}
