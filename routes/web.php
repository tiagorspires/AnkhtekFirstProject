<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index']);
Route::get('/tasks/create', [TaskController::class, 'create']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/task/{id?}', [TaskController::class, 'show']);
Route::get('/task/edit/{id}', [TaskController::class, 'edit']);
Route::put('/tasks/update/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{id?}', [UserController::class, 'show']);

