<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Common\CustomerController;
use App\Http\Controllers\Common\ServiceController;
use App\Http\Controllers\Common\UserController;
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

Route::middleware('api')->group(function () {
    /** Public Routes */
    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::post('me', [AuthController::class, 'me'])->name('me');
    });

    /** Authenticated Routes */
    Route::middleware('auth:api')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('customers', CustomerController::class);

        Route::name('customers.')->prefix('customers')->group(function () {
            Route::get('{customer}/services', [ServiceController::class, 'list'])->name('list');
            Route::post('{customer}/services', [ServiceController::class, 'attach'])->name('attach');
        });

        Route::name('services.')->prefix('services')->group(function () {
            Route::get('', [ServiceController::class, 'index'])->name('index');
            Route::put('{id}', [ServiceController::class, 'update'])->name('update');
            Route::delete('{id}', [ServiceController::class, 'destroy'])->name('destroy');
        });
    });
});
