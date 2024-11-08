<?php

use App\Http\Controllers\Api\CarBrandController;
use App\Http\Controllers\Api\CarBrandModelController;
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
//Бренд авто
Route::get('car-brands', [CarBrandController::class, 'index']);
Route::post('car-brands', [CarBrandController::class, 'store']);
Route::put('car-brands/{carBrand}', [CarBrandController::class, 'update']);
Route::delete('car-brands/{carBrand}', [CarBrandController::class, 'destroy']);
//Модель авто
Route::get('car-brands/{carBrand}/models', [CarBrandModelController::class, 'index']);
Route::post('car-brands/{carBrand}/models', [CarBrandModelController::class, 'store']);
Route::put('car-brands/{carBrand}/models/{carBrandModel}', [CarBrandModelController::class, 'update']);
Route::delete('car-brands/{carBrand}/models/{carBrandModel}', [CarBrandModelController::class, 'destroy']);
