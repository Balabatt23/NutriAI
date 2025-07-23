<?php

use Illuminate\Support\Facades\Route;

/*
/-----------------------------------------------------------
/ NAMESPACE 
/-----------------------------------------------------------
*/

use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\DailyConsumptionController;

/*
/-----------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
/--------------------------------------------------------------------------------------
/ AUTHENTICATION ROUTES
/--------------------------------------------------------------------------------------
/ Semua route yang berhubungan dengan autentikasi pengguna
/ seperti login, registrasi, dan verifikasi OTP dikelompokkan di sini.
*/

Route::get('a', [UserController::class, 'user_check']);

// Route untuk registrasi
Route::get('/registrasi', [UserController::class, 'viewRegister'])->name('registrasi');
Route::post('/register', [UserController::class, 'create'])->name('register');

// Route untuk login
Route::get('/login', [UserController::class, 'viewLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('Login');

// Route untuk login menggunakan Google
Route::get('/auth-google-redirect', [UserController::class, 'google_redirect'])->name('google_redirect');
Route::get('/auth-google-callback', [UserController::class, 'google_callback']);

// Route untuk logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Route untuk verifikasi email
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/verify', [VerifyController::class, 'index']);
    Route::post('/verify', [VerifyController::class, 'store'])->name('send_otp');
    Route::get('/verify/{unique_id}', [VerifyController::class, 'show'])->name('verify.show');
    Route::post('/verify/{unique_id}', [VerifyController::class, 'verify']);
});
/*
/--------------------------------------------------------------------------------------
*/

Route::get('/test', function() {
    return view('test');
});



Route::get('/b', [UserController::class, 'testing_model']);

Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/history', function () {
        return view('history');
    });

    Route::get('/profile', [UserController::class, 'profile_page']);

    Route::get('/scan_food', function() {
        return view('scan_food');
    });

    Route::post('/daily-consumption/create-by-pic', [DailyConsumptionController::class, 'create_by_pic'])
        ->name('daily-consumption.create-by-pic');

    Route::post('/daily-consumption/create', [DailyConsumptionController::class, 'create'])
        ->name('daily-consumption.create');
    

    Route::delete('/daily-consumption/{id}', [DailyConsumptionController::class, 'delete'])
        ->name('daily-consumption.delete');
        
    Route::get('/daily-consumption/today', [DailyConsumptionController::class, 'todayMeals']);

    Route::get('/daily-consumption/{date}', [DailyConsumptionController::class, 'get_by_date']);
});