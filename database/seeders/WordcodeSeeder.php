<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WordcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define a set of example words and hints
        $words = [
            ['word' => 'apple', 'hint1' => 'A type of fruit', 'hint2' => 'Red or green, often used in pies'],
            ['word' => 'elephant', 'hint1' => 'A large animal', 'hint2' => 'Has a trunk and big ears'],
            ['word' => 'ocean', 'hint1' => 'A large body of water', 'hint2' => 'Covers most of the Earth'],
            ['word' => 'sunflower', 'hint1' => 'A type of flower', 'hint2' => 'Turns toward the sun'],
            ['word' => 'mountain', 'hint1' => 'A tall landform', 'hint2' => 'Part of a range, great for hiking'],
            // Add more static entries here if needed
        ];

        // Insert static words
        foreach ($words as $word) {
            DB::table('wordcode')->insert([
                'word' => $word['word'],
                'hint1' => $word['hint1'],
                'hint2' => $word['hint2'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Add Faker-generated words
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 95; $i++) {
            $randomWord = $faker->word; // Random word
            DB::table('wordcode')->insert([
                'word' => $randomWord,
                'hint1' => 'Something related to ' . $randomWord,
                'hint2' => 'An additional clue for ' . $randomWord,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

