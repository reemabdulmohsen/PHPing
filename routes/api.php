<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::put('/tasks/{task}', [TaskController::class, 'completeTask']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});

Route::get('/users', [ProfileController::class, 'index']);

Route::post('/login', [AuthController::class, 'login']);