<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Image push
Route::get('/upload', [ImageController::class, 'upload']);
Route::post('/upload', [ImageController::class, 'add']);

// Register
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerAction'])->name('register.action');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginAction'])->name('login.action');

// Authentication
Route::get('/password', [UserController::class, 'password'])->name('password');
Route::post('/password', [UserController::class, 'passwordAction'])->name('password.action');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});
