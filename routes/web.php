<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
});

// Auth scaffolding (login, register, etc.)
Auth::routes();

// Home route (optional user id)
Route::get('/home/{id?}', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

// Authenticated routes
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Image Upload
    Route::post('/upload-image', [ImageUploadController::class, 'uploadImage'])->name('upload.image');

    // Admin routes (protected by AdminMiddleware)
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin') // Protect with middleware
        ->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            Route::get('/messages', [AdminController::class, 'messages'])->name('messages');

            // Actions
            Route::post('/users/{id}/toggle', [AdminController::class, 'toggleUserStatus'])->name('users.toggle');
            Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('messages.delete');
        });
});
