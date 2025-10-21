<?php

declare(strict_types=1);

Illuminate\Support\Facades\Route::prefix('v1')->group(function (): void {
    require __DIR__.'/api/v1/auth.php';
});

Illuminate\Support\Facades\Route::get('/test', fn (): Illuminate\Http\JsonResponse => response()->json('Hello world'));
