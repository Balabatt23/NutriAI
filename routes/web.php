<?php

use App\Http\Controllers\DailyConsumptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});


Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout']);


Route::get('/registrasi', function () {
    return view('registrasi');
});


Route::post('/register', [UserController::class, 'create']);

Route::get('/test', function() {
    return view('test');
});

Route::middleware('auth:web')->prefix('/')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);

    Route::get('/history', function () {
        return view('history');
    });

    Route::get('/profile', function () {
        return view('profile');
    });

    Route::post('/add-meal', [DailyConsumptionController::class, 'create']);
    Route::post('/gemini_api', [DailyConsumptionController::class, 'create_by_pic']);

});
