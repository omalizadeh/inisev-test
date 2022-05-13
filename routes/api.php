<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/tokens', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::prefix('websites/{website}')->group(function () {
        Route::apiResource('posts', PostController::class)->only('store');
        Route::post('subscribe', [SubscriptionController::class, 'store']);
    });
});
