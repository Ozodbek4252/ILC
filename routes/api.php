<?php

use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\AdvantageController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\CounterController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\PartnerController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SocialController;
use App\Http\Controllers\API\TariffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('banner/get', [BannerController::class, 'get']);
Route::get('partners', [PartnerController::class, 'index']);
Route::get('requests', [RequestController::class, 'create']);
Route::get('faqs', [FAQController::class, 'index']);
Route::get('news', [NewsController::class, 'index']);
Route::get('news/{news}', [NewsController::class, 'show']);
Route::get('advantages', [AdvantageController::class, 'index']);
Route::get('services', [ServiceController::class, 'index']);
Route::get('counters', [CounterController::class, 'index']);
Route::get('tariffs', [TariffController::class, 'index']);
Route::get('socials', [SocialController::class, 'index']);
Route::get('contacts', [ContactController::class, 'index']);
Route::get('abouts', [AboutController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
