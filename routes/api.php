<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\ContentController;
use Illuminate\Support\Facades\Route;

Route::get('/home', [ContentController::class, 'home']);
Route::get('/posts', [ContentController::class, 'posts']);
Route::get('/posts/{slug}', [ContentController::class, 'post']);
Route::get('/projects', [ContentController::class, 'projects']);

Route::middleware('throttle:10,1')->group(function () {
    Route::post('/register', [AccountController::class, 'register']);
    Route::post('/login', [AccountController::class, 'login']);
    Route::post('/forgot-password', [AccountController::class, 'forgotPassword']);
    Route::post('/reset-password', [AccountController::class, 'resetPassword']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AccountController::class, 'user']);
    Route::post('/logout', [AccountController::class, 'logout']);
    Route::post('/profile/avatar', [AccountController::class, 'avatar']);
    Route::get('/profile/comments', [AccountController::class, 'comments']);
    Route::post('/comments', [AccountController::class, 'storeComment']);
});
