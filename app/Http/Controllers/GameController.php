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
        $words = WordCode::get(['id', 'word', 'hint1', 'hint2']);  // Fetch words 
        return view('game.play', [
            'hiddenWord' => '_ _ _ _ _', // Replace with actual logic
            'timeLimit' => 60,
            'score' => 0,
            'mistakesLeft' => 5,
        ]);

       
    }

    public function showRules()
{
    return view('game.rules'); 
}




    // Start the actual game
    public function playGame(Request $request)
{
    $user = Auth::user();

    // Fetch a random word if no word_id is provided
    $wordcode = $request->word_id 
        ? WordCode::find($request->word_id)
        : WordCode::inRandomOrder()->first();

    // Handle case where no word is found
    if (!$wordcode) {
        return redirect()->back()->with('error', 'No word available to guess. Please add some words to the database.');
    }

    $timeLimit = 60; // 60 seconds for the game
    $startTime = now();
    $endTime = $startTime->addSeconds($timeLimit);

    // Save the user progress for this level
    $progress = UserProgress::firstOrCreate(
        ['user_id' => $user->id, 'level_id' => 1], // Assuming this is level 1
        ['score' => 0, 'completed' => false]
    );

    // Pass the necessary variables to the view, including $word
    return view('game.play', [
        'word' => $wordcode,
        'hiddenWord' => str_repeat('_ ', strlen($wordcode->word)), // Masked word display
        'timeLimit' => $timeLimit,
        'startTime' => $startTime,
        'endTime' => $endTime,
        'score' => $progress->score ?? 0, // Initial score
        'mistakesLeft' => 5, // Starting mistakes allowed
        'hint1' => $wordcode->hint1, // Pass first hint
    ]);
}

    // Handle the user's guess input
    public function submitGuess(Request $request)
    {
        $user = Auth::user();
        $progress = UserProgress::where('user_id', $user->id)->first();
        $word = WordCode::find($request->word_id);
    
        // Controleer of het woord bestaat
        if (!$word) {
            return redirect()->route('game.play')->with('error', 'Word not found.');
        }
    
        $currentScore = $progress->score ?? 0;
        $guess = trim($request->guess); // Trim witruimtes van de invoer
    
        // Als de invoer leeg is, geef een foutmelding
        if (empty($guess)) {
            return redirect()->back()->with('error', 'Please enter a guess before submitting.');
        }
    
        // Controleer of de gok correct is
        if (strcasecmp($word->word, $guess) === 0) {
            $progress->score += 250; // Voeg punten toe bij correct antwoord
            $progress->mistakes = $progress->mistakes ?? 0; // Zorg dat mistakes niet wordt verhoogd
        } else {
            // Bij fout antwoord
            $progress->mistakes = ($progress->mistakes ?? 0) + 1;
    
            // Controleer of het maximale aantal fouten is bereikt
            if ($progress->mistakes >= 5) {
                return redirect()->route('game.start')->with('error', 'Game over! You have reached the maximum number of mistakes.');
            }
    
            $progress->score = max(0, $currentScore - 50); // Verminder punten, maar ga niet onder 0
        }
    
        $progress->save();
    
        // Redirect terug naar de huidige woord-ID met succes of foutmelding
        return redirect()->route('game.play', ['word_id' => $word->id])
            ->with('success', $guess === $word->word ? 'Correct! You earned points.' : 'Incorrect guess. Try again!');
    }
    
    
    // End the game and save the score
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