<?php



use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\navigationController;

// Auth routes
Auth::routes();

// Game routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/game/start', [GameController::class, 'startGame'])->name('game.start');
    Route::get('/game/play', [GameController::class, 'playGame'])->name('game.play');
    Route::post('/game/submit-guess', [GameController::class, 'submitGuess'])->name('game.submit-guess');
    Route::post('/game/end', [GameController::class, 'endGame'])->name('game.end');
    Route::get('/game/next-level', [GameController::class, 'nextLevel'])->name('game.nextLevel');
    Route::get('/game/restart', [GameController::class, 'restartGame'])->name('game.restart');
});



// Other routes
Route::view('/', 'home')->name('home');
Route::view('/home', 'home')->name('home');
Route::get('/admin/admin_home', [AdminController::class, 'index'])->name('admin_home');
Route::get('/player/player_home', [AdminController::class, 'index'])->name('player_home');


Route::post('/logout', [navigationController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/login', [navigationController::class, 'login'])->name('login');

Route::get('/level1', function () {
    return view('level1_woordcode');
})->name('level1');

// Player & Admin profile routes
Route::middleware('auth')->group(function () {
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/profile/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

// Game Routes
Route::get('/game/rules', [GameController::class, 'showRules'])->name('game.rules');
Route::get('/game/start', [GameController::class, 'startGame'])->name('game.start');

Route::post('/game/submit-guess', [GameController::class, 'submitGuess'])->name('game.submit-guess');





// Admin routes
Route::middleware(['admin'])->group(function () {
    //Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');
    Route::get('/admin/profile/edit', [AdminController::class, 'edit'])->name('admin_edit');
    Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.update');
});
