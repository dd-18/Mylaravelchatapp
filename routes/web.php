<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home/{id?}', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
