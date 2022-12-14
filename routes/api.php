<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetRequestController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Location\CityController;
use App\Http\Controllers\Location\CountryController;
use App\Http\Controllers\Location\DistrictController;
use App\Http\Controllers\Location\ProvinceController;
use App\Http\Controllers\Location\SubDistrictController;
use App\Http\Controllers\LocationController;
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

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class);
    Route::post('login', LoginController::class);
    Route::post('reset-password', PasswordResetRequestController::class);
    Route::post('change-password', ChangePasswordController::class);
});


Route::prefix('location')->group(function () {
    Route::apiResource('country', CountryController::class)->parameter('country', 'locationCountry');
    Route::apiResource('province', ProvinceController::class)->parameter('province', 'locationProvince');
    Route::apiResource('city', CityController::class)->parameter('city', 'locationCity');
    Route::apiResource('district', DistrictController::class)->parameter('district', 'locationDistrict');
    Route::apiResource('sub-district', SubDistrictController::class)->parameter('sub-district', 'locationSubDistrict');
    Route::apiResource('', LocationController::class)->parameter('', 'location');
});
