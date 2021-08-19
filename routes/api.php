<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiAuthorizationController;

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

Route::group(['prefix' => 'users'], function () {
    Route::post('/store', [ApiUserController::class, 'store'])->name('api.users.store');
});

Route::group(['prefix' => 'authorization'], function() {
    Route::post('login', [ApiAuthorizationController::class, 'login'])->name('api.authorization.login');
});

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'authorization'], function() {
        Route::post('logout', [ApiAuthorizationController::class, 'logout'])->name('api.authorization.logout');
    });    
});