<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\navigationController;

// Gebruikersroutes
Route::middleware('auth')->group(function () {
    Route::get('/player/home', [navigationController::class, 'playerHome'])->name('player.home');
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/profile/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/home', [navigationController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/profile/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.update');
});

// Algemene routes
Route::get('/', function () {
    return view('home'); // Algemene homepage voor niet-ingelogde gebruikers
})->name('home');

Route::get('/dashboard', [navigationController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/logout', [navigationController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/login', [navigationController::class, 'login'])->name('login');

// Auth routes
Auth::routes();
