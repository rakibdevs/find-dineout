<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CuisineController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\RestaurentController;

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
Route::get('/restaurent/{slug}', [PageController::class,'restaurentView']);


Route::get('/admin/', [AdminController::class,'dashboard']);

Route::group(['prefix' => 'admin'], function(){
	Route::resource('zones', ZoneController::class);
	Route::resource('locations', LocationController::class);
	Route::resource('categories', CategoryController::class);
	Route::resource('cuisines', CuisineController::class);
	Route::resource('features', FeatureController::class);
	Route::resource('restaurents', RestaurentController::class);
	
	Route::get('fetch/cuisines/', [CuisineController::class, 'fetch']);
	Route::get('fetch/features/', [FeatureController::class, 'fetch']);
	Route::get('fetch/categories/', [CategoryController::class, 'fetch']);
});






