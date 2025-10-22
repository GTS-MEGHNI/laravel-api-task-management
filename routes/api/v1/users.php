<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->middleware('auth:sanctum')->group(function (): void {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
});
