<?php

namespace Routes;

use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserLoggedController;
use Illuminate\Support\Facades\Route;

Route::post('sign-in', SignInController::class);
Route::post('sign-up', SignUpController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-types', ProductTypeController::class);
    Route::apiResource('sells', SellController::class);
    Route::apiResource('taxes', TaxController::class);
    Route::apiResource('users', UserController::class);
    Route::any('users-me', UserLoggedController::class);
});


