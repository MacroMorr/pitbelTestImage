<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;


// Auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me']);

// Image
Route::get('/image/list', [ImageController::class, 'list']);
Route::post('/image/{id}', [ImageController::class, 'get'])->where('id', '\d+');
Route::post('/image/upload', [ImageController::class, 'upload']);
Route::post('/image/like', [ImageController::class, 'like']);

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
