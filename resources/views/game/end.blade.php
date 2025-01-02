<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Over</title>
</head>
<body>
    <h1>Game Over</h1>
    <p>Your score: {{ $score }}</p>
    <p>Time taken: {{ $timeTaken }} seconds</p>

    <button onclick="window.location.href='{{ route('game.restart') }}'">Restart Game</button>

    <button onclick="window.location.href='{{ route('game.nextLevel') }}'">Go to Level 2</button>
</body>
</html>
