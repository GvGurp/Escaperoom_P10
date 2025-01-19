<?php


namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Wordcode;

class WordController extends Controller
{
    /**
     * Retrieve the words and hints from the database.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $words = Wordcode::select('word', 'hint1', 'hint2')->get();

        return response()->json(['words' => $words]);
    }
}
