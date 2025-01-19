<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WordcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wordcode')->insert([
            [
                'word' => 'apple',
                'hint1' => 'A fruit that keeps the doctor away.',
                'hint2' => 'Commonly red, green, or yellow in color.',
            ],
            [
                'word' => 'summer',
                'hint1' => 'A warm season of the year.',
                'hint2' => 'Often associated with beaches and vacations.',
            ],
            [
                'word' => 'smile',
                'hint1' => 'A facial expression of happiness.',
                'hint2' => 'You do this when you’re cheerful.',
            ],
            [
                'word' => 'river',
                'hint1' => 'A large stream of water.',
                'hint2' => 'Flows into lakes or seas.',
            ],
            [
                'word' => 'train',
                'hint1' => 'A mode of transportation on tracks.',
                'hint2' => 'Often used for long journeys.',
            ],
            [
                'word' => 'chair',
                'hint1' => 'A piece of furniture to sit on.',
                'hint2' => 'Often found around tables.',
            ],
            [
                'word' => 'bread',
                'hint1' => 'A staple food made from flour and water.',
                'hint2' => 'Often used to make sandwiches.',
            ],
            [
                'word' => 'cloud',
                'hint1' => 'Seen in the sky, often white or gray.',
                'hint2' => 'Can bring rain or snow.',
            ],
            [
                'word' => 'dance',
                'hint1' => 'A rhythmic movement to music.',
                'hint2' => 'Often done at celebrations.',
            ],
            [
                'word' => 'light',
                'hint1' => 'What illuminates a dark room.',
                'hint2' => 'The opposite of heavy.',
            ],
            [
                'word' => 'piano',
                'hint1' => 'A musical instrument with keys.',
                'hint2' => 'Often found in concerts and homes.',
            ],
            [
                'word' => 'flower',
                'hint1' => 'A plant part often given as a gift.',
                'hint2' => 'Known for its petals and fragrance.',
            ],
            [
                'word' => 'phone',
                'hint1' => 'Used to make calls.',
                'hint2' => 'Smart ones can run apps too.',
            ],
            [
                'word' => 'water',
                'hint1' => 'Essential for all life.',
                'hint2' => 'Covers about 70% of Earth’s surface.',
            ],
            [
                'word' => 'pencil',
                'hint1' => 'Used for writing or drawing.',
                'hint2' => 'Erasable and often made of wood.',
            ],
        ]);
    }
}

