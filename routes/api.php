<?php

use App\Http\Controllers\Api\ApiAuthorizationController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiHistoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiUserController;
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

Route::group(['prefix' => 'users'], function () {
    Route::post('store', [ApiUserController::class, 'store'])->name('api.users.store');
});

Route::group(['prefix' => 'authorization'], function () {
    Route::post('login', [ApiAuthorizationController::class, 'login'])->name('api.authorization.login');
});

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'authorization'], function () {
        Route::post('logout', [ApiAuthorizationController::class, 'logout'])->name('api.authorization.logout');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::post('store', [ApiCategoryController::class, 'store'])->name('api.categories.store');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::post('store', [ApiProductController::class, 'store'])->name('api.products.store');
    });

    Route::group(['prefix' => 'histories'], function () {
        Route::get('fetch', [ApiHistoryController::class, 'fetch'])->name('api.histories.fetch');
    });
});
