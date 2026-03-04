<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'API works'
    ]);
});

Route::post('/tasks', [TaskController::class, 'store']);
