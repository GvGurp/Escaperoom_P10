@extends('layout.main_layout')

@section('content')
<div class="container mx-auto p-6">
    <!-- Main Card -->
    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg flex items-center">
        <div class="w-1/3">
            <!-- Placeholder for Image -->
            <img src="../public/images/download.jpg" alt="">
        </div>
        <div class="ml-6">
            <h1 class="text-4xl font-bold">Welcome to My Laravel Project</h1>
            <h2 class="text-2xl mt-4">
                Totoro, the friendly forest spirit, has wandered too deep into the woods and now finds himself lost in a mysterious forest.<br>
                He needs your help to find his way back home! But the journey isn’t easy.<br> 
                The forest is full of challenges that only the bravest can overcome.
            </h2>
            <p class="mt-2">There are 3 levels of challenges. Complete them to progress!</p>
        </div>
        <div class="ml-6">
            <h2 class="text-2xl mt-4">Create an account to play ^_^</h2>
            <h2 class="text-2xl mt-4">>>>>></h2>
            <a href="{{ route('register') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Register
            </a>
            <a href="{{ route('login') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Log In
            </a>
        </div>
    </div>

    <!-- 3 Separate Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8">
        <!-- Card 1 -->
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
            <div class="bg-gray-500 h-48 rounded-lg mb-4"></div>
            <h2 class="text-xl font-semibold">Level 1</h2>
            <p>Solve a game of Hangman to unlock the path.</p>
            <form action="{{ route('game.rules') }}" method="GET">
                <button type="submit" class="block mt-4 bg-blue-500 text-white text-center py-2 px-4 rounded hover:bg-blue-600">
                    Start Game
                </button>
            </form>
        </div>
        <!-- Card 2 -->
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
            <div class="bg-gray-500 h-48 rounded-lg mb-4"></div>
            <h2 class="text-xl font-semibold">Level 2</h2>
            <p>Complete a math puzzle to continue forward</p>
        </div>
        <!-- Card 3 -->
        <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg">
            <div class="bg-gray-500 h-48 rounded-lg mb-4"></div>
            <h2 class="text-xl font-semibold">Level 3</h2>
            <p>Navigate through a maze to find the way out!</p>
        </div>
    </div>
</div>

<!-- Game Rules Page -->
<div id="gameRules" class="hidden">
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-xl font-semibold">Game Rules</h2>
            <p>Guess as many words as you can within 60 seconds!</p>
            <p>If you make 4 mistakes, the word is skipped. If the little man loses all limbs, the game endshaaaaaaaaaaaaaaa!</p>
            <form action="{{ route('game.start') }}" method="GET">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                    Start Game
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
