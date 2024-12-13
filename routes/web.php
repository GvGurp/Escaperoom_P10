<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\navigationController;

// Gebruikersroutes
Route::middleware('auth')->group(function () {
    //Route::get('/player/home', [navigationController::class, 'playerHome'])->name('player.home');
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

Route::view('/', 'home')->name('home');
Route::view('/home', 'home')->name('home');
Route::get('admin/admin_home', [AdminController::class, 'index'])->name('admin_home');
Route::get('player/player_home', [AdminController::class, 'index'])->name('player_home');



Route::post('/logout', [navigationController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/login', [navigationController::class, 'login'])->name('login');

// Auth routes
Auth::routes();
