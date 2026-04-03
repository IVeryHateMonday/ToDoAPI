<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/test', function () {
    return response()->json([
        'message' => 'API works'
    ]);
});

Route::post('/tasks', [TaskController::class, 'store']);

Route::post('/register', [UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
