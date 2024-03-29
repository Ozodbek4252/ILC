<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LangController;
use App\Http\Controllers\Dashboard\LogoController;
use App\Http\Controllers\Dashboard\ProfileController;

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

Route::get('/', function () {
    return view('front.welcome');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'doRegister'])->name('register.post');

Route::middleware([
    'auth:sanctum',
    'revalidate',
    // 'isAdmin',
    // 'language',
])->group(function () {
    Route::get('change-lang/{lang}', [LangController::class, 'changeLang'])->name('lang.change');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::resource('langs', LangController::class);

    Route::get('logos', [LogoController::class, 'index'])->name('logos.index');
    Route::put('logos/{logo}', [LogoController::class, 'update'])->name('logos.update');
});
