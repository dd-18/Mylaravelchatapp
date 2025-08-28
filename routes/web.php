<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home/{id?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Image Upload
    Route::post('/upload-image', [ImageUploadController::class, 'uploadImage'])->name('upload.image');


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/messages', [AdminController::class, 'messages'])->name('messages');

        // Actions
        Route::post('/users/{id}/toggle', [AdminController::class, 'toggleUserStatus'])->name('users.toggle');
        Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('messages.delete');
    });
});
