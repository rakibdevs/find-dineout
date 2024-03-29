<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookingController as AdminBooking;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CuisineController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\RestaurentController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
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
Route::get('/restaurents', [PageController::class,'restaurents']);
Route::get('/restaurents/{slug}', [PageController::class,'restaurentView']);
Route::get('/restaurents/{type}/{slug}', [PageController::class,'restaurentFilter']);
Route::get('/privacy-policy', [PageController::class,'privacy']);

Route::get('/login', [AuthController::class,'index'])->name('login');
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::get('/logout', [AuthController::class,'logout']);
Route::post('/login', [AuthController::class,'login']);

Route::post('/bookings/store', [BookingController::class,'store']);

Route::group(['middleware' => 'auth'], function(){

	Route::get('/admin/', [AdminController::class,'dashboard']);

	Route::group(['prefix' => 'admin'], function(){
		Route::resource('zones', ZoneController::class);
		Route::resource('locations', LocationController::class);
		Route::resource('categories', CategoryController::class);
		Route::resource('cuisines', CuisineController::class);
		Route::resource('features', FeatureController::class);
		Route::resource('restaurents', RestaurentController::class);
		Route::resource('offers', OfferController::class);
		
		Route::get('bookings', [AdminBooking::class,'index']);
		Route::get('bookings/{id}', [AdminBooking::class,'show']);
		Route::get('fetch/bookings', [AdminBooking::class,'fetch']);
		Route::get('fetch/daily-bookings', [AdminBooking::class,'dailyBooking']);
		Route::get('fetch/dashboard-statistics', [AdminController::class,'dashboardStatistics']);
		
		Route::get('fetch/offers/', [OfferController::class, 'fetch']);
		Route::get('fetch/restaurents/', [RestaurentController::class, 'fetch']);
		Route::get('fetch/top-restaurents/', [RestaurentController::class, 'topRestaurents']);
		Route::get('fetch/cuisines/', [CuisineController::class, 'fetch']);
		Route::get('fetch/features/', [FeatureController::class, 'fetch']);
		Route::get('fetch/categories/', [CategoryController::class, 'fetch']);
		Route::get('fetch/zones/', [ZoneController::class, 'fetch']);
		Route::get('fetch/locations/', [LocationController::class, 'fetch']);
	});
});





