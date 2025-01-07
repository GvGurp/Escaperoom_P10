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
            <div class="flex justify-center space-x-4 mt-6"> <button onclick="startGame()" class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">Start Game </button>
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
       <script> 
        // Function to Show SweetAlert2 and Start Timer
function startGame() {
    Swal.fire({
        title: 'Game Rules',
        html: `
            <ul class="text-left text-sm space-y-2">
                <li>Click <strong>Start Game</strong> to begin.</li>
                <li>A <strong>30-second timer</strong> will start.</li>
                <li>Solve <strong>3 math puzzles</strong> by adding the values shown.</li>
                <li>Enter your answer and click <strong>Submit</strong>.</li>
                <li>Keep trying until you get the correct answer.</li>
                <li>If time runs out, click <strong>Try Again</strong> to restart.</li>
            </ul>
        `,
        icon: 'info',
        confirmButtonText: 'Start'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('game.play') }}"; 
        }
    });
}

       </script>
@endsection
