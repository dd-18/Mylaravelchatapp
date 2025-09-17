<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Auth\Middleware\Authenticate;

// Public Routes
Route::view('/', 'welcome')->name('welcome');
Route::view('/about', 'about')->name('about');
Route::view('/features', 'features')->name('features');
Route::view('/faq', 'faq')->name('faq');
Route::view('/contact', 'contact')->name('contact');
Route::view('/pricing', 'pricing')->name('pricing');



// Auth scaffolding (login, register, forgot password, etc.)
Auth::routes();



// Authenticated Routes
Route::middleware('auth')->group(function () {

    // User home/dashboard
    Route::get('/home/{id?}', [HomeController::class, 'index'])->name('home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Image Upload
    Route::post('/upload-image', [ImageUploadController::class, 'uploadImage'])->name('upload.image');



    // Admin Routes
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('admin')
        ->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            Route::get('/messages', [AdminController::class, 'messages'])->name('messages');

            // Actions
            Route::post('/users/{id}/toggle', [AdminController::class, 'toggleUserStatus'])->name('users.toggle');
            Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('messages.delete');
            Route::get('/messages/{id}/edit', [AdminController::class, 'editMessage'])->name('messages.edit');
            Route::post('/messages/{id}/update', [AdminController::class, 'updateMessage'])->name('messages.update');
        });
});
