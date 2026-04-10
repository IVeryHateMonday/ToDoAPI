<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/test', function () {
    return response()->json([
        'message' => 'API works'
    ]);
});


Route::post('/register', [UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::prefix('user')->group(function () {
            Route::get('/me', [UserController::class, 'me']);
        });
        Route::post('/tasks', [TaskController::class, 'store']);
    });
