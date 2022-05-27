<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ImageController::class, 'list']);
Route::post('/upload', [ImageController::class, 'upload']);
Route::post('/upload/{image_controller:id}', [ImageController::class, 'get']);



/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
