<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

// Image push
Route::get('/upload', [ImageController::class, 'upload']);
Route::post('/upload', [ImageController::class, 'add']);


Route::get('/', function () {
    return view('welcome');
});
