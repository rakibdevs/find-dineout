<?php

use App\Http\Controllers\API\CuisineController;
use App\Http\Controllers\API\OfferController;
use App\Http\Controllers\API\RestaurentController;
use App\Http\Controllers\API\ZoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/fetch/restaurents', [RestaurentController::class,'get']);
Route::get('/fetch/offers', [OfferController::class,'get']);
Route::get('/fetch/cuisines', [CuisineController::class,'get']);
Route::get('/fetch/features', [FeatureController::class,'get']);
Route::get('/fetch/categories', [CategoryController::class,'get']);

Route::get('/fetch/zones/available', [ZoneController::class,'available']);
