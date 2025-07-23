<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\DailyConsumptionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('a', [UserController::class, 'user_check']);

Route::get('/registrasi', [UserController::class, 'viewRegister'])->name('registrasi');
Route::get('/login', [UserController::class, 'viewLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('Login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/register', [UserController::class, 'create'])->name('register');

Route::get('/test', function() {
    return view('test');
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/verify', [VerifyController::class, 'index']);
    Route::post('/verify', [VerifyController::class, 'store'])->name('send_otp');
    Route::get('/verify/{unique_id}', [VerifyController::class, 'show'])->name('verify.show');
    Route::post('/verify/{unique_id}', [VerifyController::class, 'verify']);
});


Route::get('/b', [UserController::class, 'testing_model']);


Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);

    Route::get('/history', function () {
        return view('history');
    });

    Route::get('/profile', [UserController::class, 'profile_page']);

    Route::get('/scan_food', function() {
        return view('scan_food');
    });
    
    Route::get('/daily-consumption', [DailyConsumptionController::class, 'get_by_date']);
    
    Route::post('/daily-consumption/create-by-pic', [DailyConsumptionController::class, 'create_by_pic'])
        ->name('daily-consumption.create-by-pic');

    Route::post('/daily-consumption/create', [DailyConsumptionController::class, 'create'])
        ->name('daily-consumption.create');
    

    Route::delete('/daily-consumption/{id}', [DailyConsumptionController::class, 'delete'])
        ->name('daily-consumption.delete');
        
    Route::get('/daily-consumption/today', [DailyConsumptionController::class, 'todayMeals']);



});

// Route::group(['middleware' => ['auth:web', 'checkStatus']], function () {
//     Route::get('/dashboard', [UserController::class, 'dashboard']);

//     Route::get('/history', function () {
//         return view('history');
//     });

//     Route::get('/profile', function () {
//         return view('profile');
//     });

//     Route::post('/add-meal', [DailyConsumptionController::class, 'create']);
//     Route::post('/gemini_api', [DailyConsumptionController::class, 'create_by_pic']);

// });
