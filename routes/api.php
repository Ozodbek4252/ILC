<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\FAQController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\PartnerController;
use App\Http\Controllers\API\RequestController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
