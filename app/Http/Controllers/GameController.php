<?php

namespace App\Http\Controllers;

use App\Models\WordCode; // Model voor woordcodes (Gaby)
use App\Models\UserProgress; // Model voor gebruikersvoortgang (Gaby)
use Illuminate\Http\Request; // Om verzoeken te verwerken (Gaby)
use Illuminate\Support\Facades\Auth; // Authenticatie (Gaby)
use Carbon\Carbon; // Voor tijdsberekeningen (Gaby)

class GameController extends Controller
{
    /**
     * Toon de spelregels voordat het spel begint (Gaby)
     */
    public function startGame()
    {
        $user = Auth::user(); // Haal de ingelogde gebruiker op (Gaby)

        // Reset score en fouten bij een nieuw spel (Gaby)
        UserProgress::updateOrCreate(
            ['user_id' => $user->id, 'level_id' => 1], // Gebruiker en level-id (Gaby)
            ['score' => 0, 'completed' => false, 'mistakes' => 0] // Reset data (Gaby)
        );

        return view('level1_woordcode', [ // Laad de level 1 view (Gaby)
            'hiddenWord' => '_ _ _ _ _', // Verborgen woord placeholder (Gaby)
            'timeLimit' => 60, // Tijdslimiet in seconden (Gaby)
            'score' => 0, // Startscore (Gaby)
            'mistakesLeft' => 5, // Maximum aantal fouten (Gaby)
        ]);
    }

    /**
     * Verwerk het spel als een gebruiker een poging doet (Gaby)
     */
    public function playGame(Request $request)
    {
        $user = Auth::user(); // Haal de ingelogde gebruiker op (Gaby)

        // Haal een willekeurige of opgegeven woordcode op (Gaby)
        $wordcode = $request->word_id 
            ? WordCode::find($request->word_id) 
            : WordCode::inRandomOrder()->first();

        if (!$wordcode) { // Controleer of er een woord is (Gaby)
            return redirect()->back()->with('error', 'Geen woorden beschikbaar. Voeg woorden toe aan de database.'); // Foutmelding (Gaby)
        }

        // Haal voortgang op of maak deze aan voor level 1 (Gaby)
        $progress = UserProgress::firstOrCreate(
            ['user_id' => $user->id, 'level_id' => 1], // Gebruiker en level-id (Gaby)
            ['score' => 0, 'completed' => false, 'mistakes' => 0, 'start_time' => now()] // Initiële data (Gaby)
        );

        $timeElapsed = $progress->start_time ? now()->diffInSeconds($progress->start_time) : 0; // Tijd verlopen sinds start (Gaby)
        $timeLimit = 60; // Tijdslimiet (Gaby)
        $remainingTime = max(0, $timeLimit - $timeElapsed); // Bereken resterende tijd (Gaby)

        $progress->update(['remaining_time' => $remainingTime]); // Update resterende tijd (Gaby)

        return view('level1_woordcode', [ // Toon de level 1 view (Gaby)
            'word' => $wordcode, // Huidig woord (Gaby)
            'hiddenWord' => str_repeat('_ ', strlen($wordcode->word)), // Verborgen woord (Gaby)
            'remainingTime' => $remainingTime, // Resterende tijd (Gaby)
            'score' => $progress->score, // Score van gebruiker (Gaby)
            'mistakesLeft' => 5 - ($progress->mistakes ?? 0), // Overgebleven fouten (Gaby)
            'hint1' => $wordcode->hint1, // Eerste hint (Gaby)
        ]);
    }

    /**
     * Verwerk de ingediende poging van een gebruiker (Gaby)
     */
    public function submitGuess(Request $request)
    {
        $user = Auth::user(); // Haal de ingelogde gebruiker op (Gaby)
        $progress = UserProgress::where('user_id', $user->id)->first(); // Haal gebruikersvoortgang op (Gaby)
        $word = WordCode::find($request->word_id); // Haal het woord op uit de database (Gaby)

        if (!$word) { // Controleer of het woord bestaat (Gaby)
            return redirect()->route('game.play')->with('error', 'Woord niet gevonden.'); // Foutmelding (Gaby)
        }

        $currentScore = $progress->score ?? 0; // Huidige score van gebruiker (Gaby)
        $guess = trim($request->guess); // Haal invoer van gebruiker op en trim spaties (Gaby)

        if (empty($guess)) { // Controleer of de invoer leeg is (Gaby)
            return redirect()->back()->with('error', 'Vul een woord in voordat je indient.'); // Foutmelding (Gaby)
        }

        if (strcasecmp($word->word, $guess) === 0) { // Controleer of het woord correct is (Gaby)
            $progress->score += 250; // Voeg punten toe (Gaby)
            $progress->save(); // Sla voortgang op (Gaby)

            $nextWord = WordCode::where('id', '!=', $word->id)->inRandomOrder()->first(); // Haal volgend woord op (Gaby)

            if (!$nextWord) { // Controleer of er meer woorden zijn (Gaby)
                return redirect()->route('game.end')->with('success', 'Gefeliciteerd! Alle woorden zijn geraden.'); // Spel beëindigen (Gaby)
            }

            return redirect()->route('game.play', [ // Ga naar volgend woord (Gaby)
                'word_id' => $nextWord->id,
            ])->with('success', 'Correct! Volgend woord geladen.'); // Succesbericht (Gaby)
        } else {
            $progress->mistakes = ($progress->mistakes ?? 0) + 1; // Verhoog aantal fouten (Gaby)

            if ($progress->mistakes >= 5) { // Controleer op maximale fouten (Gaby)
                return redirect()->route('game.start')->with('error', 'Game over! Je hebt het maximale aantal fouten bereikt.'); // Foutmelding (Gaby)
            }

            $progress->score = max(0, $currentScore - 50); // Verminder score (Gaby)
            $progress->save(); // Sla voortgang op (Gaby)

            return redirect()->route('game.play', ['word_id' => $word->id]) // Ga terug naar hetzelfde woord (Gaby)
                ->with('error', 'Incorrect. Probeer het opnieuw!'); // Foutmelding (Gaby)
        }
    }

    /**
     * Update de resterende tijd op basis van gebruikersacties (Gaby)
     */
    public function updateTime(Request $request)
    {
        $user = Auth::user(); // Haal de ingelogde gebruiker op (Gaby)
        $progress = UserProgress::where('user_id', $user->id)->first(); // Haal gebruikersvoortgang op (Gaby)

        if ($progress) { // Controleer of voortgang bestaat (Gaby)
            $remainingTime = $request->remaining_time ?? 60; // Haal resterende tijd op (Gaby)
            $progress->update(['remaining_time' => $remainingTime]); // Update tijd (Gaby)
            return response()->json(['status' => 'success']); // Succesmelding (Gaby)
        }

        return response()->json(['status' => 'error']); // Foutmelding (Gaby)
    }

    /**
     * Beëindig het spel voor de gebruiker (Gaby)
     */
    public function endGame(Request $request)
    {
        $user = Auth::user(); // Haal de ingelogde gebruiker op (Gaby)
        $progress = UserProgress::where('user_id', $user->id)->first(); // Haal gebruikersvoortgang op (Gaby)
        $progress->completed = true; // Markeer level als voltooid (Gaby)
        $progress->save(); // Sla voortgang op (Gaby)

        return redirect()->route('game.start'); // Ga terug naar het startscherm (Gaby)
    }
}
