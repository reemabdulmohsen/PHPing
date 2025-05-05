<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::middleware('auth:sanctum')->prefix('task')->group(function () {
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/', [TaskController::class, 'index']);
    Route::put('/{task_id}', [TaskController::class, 'completeTask']);
    Route::delete('/{task_id}', [TaskController::class, 'destroy']);
    Route::get('/{task_id}', [TaskController::class, 'show']);
});

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
});
