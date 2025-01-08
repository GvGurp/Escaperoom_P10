<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Mini-Game</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include SweetAlert2 from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Guess the Total Value!</h1>

    <div id="images-container" class="flex justify-center w-full"></div>

    <div class="flex justify-center items-center mb-4">
        <input type="number" id="guess" class="p-2 border border-gray-300 rounded-md w-36 text-center"
               placeholder="Enter your guess">
        <button onclick="checkGuess()" class="ml-4 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
            Submit
        </button>
    </div>

    <p id="result" class="text-center text-xl font-semibold text-gray-700"></p>

    <div class="flex justify-center space-x-4 mt-6">
        {{--        <button onclick="startGame()" class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">Start--}}
        {{--            Game--}}
        {{--        </button>--}}
        <div id="safeTimerDisplay" class="text-xl font-semibold text-gray-700">00:30</div>
        <button onclick="timer()" id="startTimerBtn"
                class="px-6 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-700">Start Timer
        </button>
    </div>

    <!-- Try Again Button (Hidden Initially) -->
    <button id="tryAgainBtn" onclick="restartGame()"
            class="mt-4 px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-700" style="display: none;">Try Again
    </button>
</div>


<script>
    startGame()

    // Timer Function
    let gameTimer; // Declare a global variable to store the timer

    function timer() {
        let sec = 30;
        document.getElementById('startTimerBtn').style.display = 'none'; // Hide start button when timer starts

        gameTimer = setInterval(function () {
            document.getElementById('safeTimerDisplay').innerHTML = '00:' + (sec < 10 ? '0' : '') + sec;
            sec--;
            if (sec < 0) {
                clearInterval(gameTimer);
                restartGame(); // Show restart prompt when time is up
            }
        }, 1000);
    }

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
                resetGame(); // Reset game state and start the game
                timer(); // Start the timer
            }
        });
    }

    // Restart the Game completely
    function restartGame() {
        Swal.fire({
            title: 'you lose',
            html: `
            <ul class="text-left text-sm space-y-2">

                <li>sorry youre time is up</li>
                <li><strong>Try Again</strong></li>
            </ul>
        `,
            icon: 'info',
            confirmButtonText: 'restart'
        }).then((result) => {
            if (result.isConfirmed) {
                resetGame(); // Reset the game
                timer(); // Restart the timer
            }
        });
    }

    // Reset the game state
    function resetGame() {
        document.getElementById('tryAgainBtn').style.display = 'none'; // Hide the "Try Again" button
        document.getElementById('guess').value = ''; // Clear the guess input field
        document.getElementById('result').textContent = ''; // Clear the result text
        document.getElementById('images-container').innerHTML = ''; // Clear the images
        level = 1; // Reset level
        totalValue = 0; // Reset total value
        loadLevel(); // Load the first level of the game
    }

    const images = [
        {src: '../../public/images/apple.jpg', value: 1},
        {src: '../../public/images/banana.png', value: 2},
        {src: '../../public/images/orange.jpg', value: 3}
    ];

    let level = 1;
    let totalValue = 0;

    function loadLevel() {
        const imagesContainer = document.getElementById('images-container');
        imagesContainer.innerHTML = ''; // Clear previous images

        const randomImages = [];
        for (let i = 0; i < level + 2; i++) {
            const randomIndex = Math.floor(Math.random() * images.length);
            randomImages.push(images[randomIndex]);
        }

        totalValue = randomImages.reduce((sum, img) => sum + img.value, 0);

        randomImages.forEach(image => {
            const imgElement = document.createElement('img');
            imgElement.src = image.src;
            imgElement.alt = 'Image';
            imgElement.classList.add('w-24', 'h-24', 'object-cover');
            imagesContainer.appendChild(imgElement);
        });
    }

    function checkGuess() {
        const guess = parseInt(document.getElementById('guess').value);
        const result = document.getElementById('result');

        if (guess === totalValue) {
            result.textContent = 'Correct! 🎉';
            document.getElementById('guess').value = '';
            if (level === 3) {
                showCompletionMessage();
            } else {
                level++;
                loadLevel();
            }
        } else {
            result.textContent = 'Wrong! Try again.';
        }
    }

    function showCompletionMessage() {
        clearInterval(gameTimer); // Stop the timer when the player completes all levels
        Swal.fire({
            title: 'Congratulations!',
            text: 'You completed all levels!',
            icon: 'success',
            confirmButtonText: 'Next Page'
        }).then(() => {
            window.location.href = 'nextpage.html'; // Replace with your desired page URL
        });
    }


</script>

</body>
</html>




