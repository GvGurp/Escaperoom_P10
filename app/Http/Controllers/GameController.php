<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WordCode;

class GameController extends Controller
{
    public function index()
    {
        // Initialize game state
        session([
            'score' => 0,
            'currentIndex' => 0, // Track current word index
        ]);

        return $this->nextWord();
    }

    public function nextWord()
    {
        $words = WordCode::all();

        if ($words->isEmpty()) {
            return redirect
            ('/')->with('error', 'No words available for the game!');
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
        ];

        return view('level1_woordcode', [
            'score' => session('score', 0),
            'gameData' => $gameData,
            'timer' => 60,
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

        // Check if the guess is correct
        if ($guess === strtolower($currentWord->word)) {
            // Correct answer
            session(['score' => session('score', 0) + 100]); // Add 100 points
            session(['currentIndex' => $currentIndex + 1]); // Move to the next word
            return redirect()->route('game.nextWord')->with('message', 'Correct! You earned 100 points.');
        } else {
            // Incorrect answer
            session(['score' => session('score', 0) - 50]); // Deduct 50 points
            return redirect()->route('game.nextWord')->with('message', 'Incorrect! You lost 50 points.');
        }
    }
}
