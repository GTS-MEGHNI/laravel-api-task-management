<?php

declare(strict_types=1);

use App\Http\Controllers\UserController;

Illuminate\Support\Facades\Route::prefix('users')->middleware('auth:sanctum')->group(function (): void {
    Illuminate\Support\Facades\Route::get('/', [UserController::class, 'index']);
});
