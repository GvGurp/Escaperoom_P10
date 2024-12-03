<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\navigationController;

Route::get('/', function () {
    return view('home');
});


Route::get('/home', [navigationController::class, 'home'])->name('home');
Route::get('/dashboard', [navigationController::class, 'dashboard'])->middleware('auth')->name('dashboard'); // Voor gebruikers/admins
Route::post('/logout', [navigationController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/login', [navigationController::class, 'login'])->name('login'); // Inclusief registratie
Route::get('/admin', [navigationController::class, 'admin'])->middleware(['auth', 'admin'])->name('admin'); // Alleen admin

Auth::routes();
