<?php

use App\Http\Controllers\OfferController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RestaurentController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class,'index']);


Route::get('/fetch/restaurents', [RestaurentController::class,'fetch']);
Route::get('/fetch/', [RestaurentController::class,'fetch']);
Route::get('/fetch/offers', [OfferController::class,'fetch']);
Route::get('/fetch/available-zones', [ZoneController::class,'available']);
