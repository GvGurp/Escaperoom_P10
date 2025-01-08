<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class ScoreController extends Controller
{
    public function saveScore(Request $request)
    {
        $request->validate([
            'level_id' => 'required|integer',
            'time' => 'required|string',
        ]);

        $score = new Score();
        $score->user_id = auth()->id();
        $score->level_id = $request->level_id;
        $score->points = $this->calculatePoints($request->time); // Convert time to points
        $score->save();

        return response()->json(['success' => true, 'message' => 'Score saved successfully']);
    }

    // Calculate points based on remaining time
    private function calculatePoints($time)
    {
        list($minutes, $seconds) = explode(':', $time);
        $totalSeconds = ($minutes * 60) + $seconds;

        // Example calculation: 1 point for each remaining second
        return $totalSeconds;
    }
}
