<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');

Route::middleware('guest')->group(function () {
	// Роуты авторизации
	Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
	Route::post('/register', [AuthController::class, 'register']);
	Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
	Route::post('/login', [AuthController::class, 'login']);

	// Маршруты для сброса пароля
	// Закомментировал пока не использую отправку писем на почту
	// Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
	// Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
	// Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
	// Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
	Route::get('/reset-password', [ResetPasswordController::class, 'showResetFormWithoutEmail'])->name('password.request.form');
	Route::post('/reset-password', [ResetPasswordController::class, 'resetWithoutEmail'])->name('password.update.form');
});

Route::middleware('auth')->group(function () {
	Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
	Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
	Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
	Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update_avatar');
});
