<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\LocationController;
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

// Route::get('/gps/store', LocationController::class);
Route::post('/gps/store', [LocationController::class, 'store']);
Route::get('/latest-locations', [LocationController::class, 'latest']);