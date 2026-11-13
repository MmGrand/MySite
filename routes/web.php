<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'spa')->name('home');
Route::view('/about', 'spa')->name('about');
Route::view('/contacts', 'spa')->name('contacts');
Route::view('/projects', 'spa')->name('projects.index');
Route::view('/posts', 'spa')->name('posts.index');
Route::view('/posts/{slug}', 'spa')->name('posts.show');
Route::view('/login', 'spa')->name('login');
Route::view('/register', 'spa')->name('register');
Route::view('/forgot-password', 'spa')->name('password.request');
Route::view('/reset-password/{token}', 'spa')->name('password.reset');
Route::view('/profile', 'spa')->name('profile');
