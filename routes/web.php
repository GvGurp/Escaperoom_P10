<?php



use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\navigationController;

// Auth routes
Auth::routes();

// Other routes
Route::view('/', 'home')->name('home');
Route::view('/home', 'home')->name('home');
Route::get('/admin/admin_home', [AdminController::class, 'index'])->name('admin_home');
Route::get('/player/player_home', [AdminController::class, 'index'])->name('player_home');
Route::post('/logout', [navigationController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/login', [navigationController::class, 'login'])->name('login');

// Player & Admin profile routes
Route::middleware('auth')->group(function () {
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/profile/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

// Admin routes
Route::middleware(['admin'])->group(function () {
    //Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');
    Route::get('/admin/profile/edit', [AdminController::class, 'edit'])->name('admin_edit');
    Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.update');
});

//Routes for level1 
Route::get('/level1_woordcode', function () { return view('level1_woordcode');})->name('level1.woordcode');
Route::get('/popUp', function () { return view('popUp');})->name('popUp');

Route::group(['prefix' => 'game'], function () {
    Route::get('/start', [GameController::class, 'startGame'])->name('game.start');  // Start the game
    Route::get('/play', [GameController::class, 'playGame'])->name('game.play');    // Play the game
    Route::post('/submit-guess', [GameController::class, 'submitGuess'])->name('game.submit-guess');  // Submit a guess
    Route::get('/end', [GameController::class, 'endGame'])->name('game.end');       // End the game
});

Route::post('/game/update-time', [GameController::class, 'updateTime'])->name('game.update-time');
