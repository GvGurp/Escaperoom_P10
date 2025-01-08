<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wordcode;  // Correct model name
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    public function play()
    {
        // Call the playGame function to get the first word
        return $this->playGame();
    }

    public function playGame()
    {
        // Get the current word id from the session
        $currentWordId = Session::get('currentWordId', 1);  // Default to 1 or first word

        // Retrieve the word using the model 'wordcode'
        $currentWord = Wordcode::find($currentWordId);  // Changed to match your model

        if (!$currentWord) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }

        // Hide the actual word, display hidden version
        $hiddenWord = str_repeat('_ ', strlen($currentWord->word));

        return view('game.play', [
            'hiddenWord' => $hiddenWord,
            'remainingTime' => 60,  // Timer in seconds (initial value)
            'mistakesLeft' => 5,
            'score' => 0,
            'hint1' => $currentWord->hint1,
        ]);
    }

    public function submitGuess(Request $request)
    {
        $guess = $request->input('guess');
        $currentWordId = Session::get('currentWordId');

        // Retrieve current word details from the 'wordcode' table
        $currentWord = Wordcode::find($currentWordId);  // Changed to match your model
        
        if (!$currentWord) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        
        if ($guess === $currentWord->word) {
            // Correct guess - update score, reset mistakes, load next word
            $userProgress = auth()->user()->progress;
            $userProgress->score += 100;  // Increment score
            $userProgress->mistakesLeft = 5;  // Reset mistakes count
            $userProgress->remainingTime = 60;  // Reset timer
            
            // Load next word
            $nextWord = Wordcode::where('id', '>', $currentWordId)->first();
            if (!$nextWord) {
                return redirect()->route('game.end')->with('message', 'Game completed!');
            }
            
            Session::put('currentWordId', $nextWord->id);
            return redirect()->route('game.play');
        } else {
            // Incorrect guess, decrease mistakes
            $userProgress = auth()->user()->progress;
            $userProgress->mistakesLeft -= 1;
            $userProgress->save();
            
            if ($userProgress->mistakesLeft <= 0) {
                return redirect()->route('game.end')->with('message', 'Game Over! You ran out of attempts.');
            }

            return redirect()->back()->with('error', 'Incorrect guess, try again!');
        }
    }
}
