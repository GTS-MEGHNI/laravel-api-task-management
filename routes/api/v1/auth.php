<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\OtpAccountActivationController;
use App\Http\Controllers\Api\V1\RegisterController;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function (): void {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', RegisterController::class);
    Route::prefix('otp')->group(function (): void {
        Route::prefix('account-activation')->group(function (): void {
            Route::post('verify', [OtpAccountActivationController::class, 'verify']);
        });
    });
    Route::middleware(['auth:sanctum', EnsureEmailIsVerified::class])->group(function (): void {
        Route::get('me', [AuthController::class, 'getAuthUser']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
