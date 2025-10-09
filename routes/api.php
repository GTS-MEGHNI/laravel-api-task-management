<?php

declare(strict_types=1);

use App\Http\Controllers\MockApiController;
use Illuminate\Support\Facades\Route;

Route::get('test-success', [MockApiController::class, 'testSuccess']);
Route::get('test-error', [MockApiController::class, 'testError']);
Route::get('test-not-found', [MockApiController::class, 'testNotFound']);
Route::get('test-unauthorized', [MockApiController::class, 'testUnauthorized']);
Route::get('test-forbidden', [MockApiController::class, 'testForbidden']);
Route::get('test-internal-error', [MockApiController::class, 'testInternalError']);
Route::get('test-no-content', [MockApiController::class, 'testNoContent']);
Route::get('test-created', [MockApiController::class, 'testCreated']);
Route::get('test-pagination', [MockApiController::class, 'testWithPagination']);
Route::get('test-validation-error', [MockApiController::class, 'testValidationErrors']);
Route::get('test-method-not-allowed', [MockApiController::class, 'testMethodNotAllowed']);
Route::get('test-too-many-requests', [MockApiController::class, 'testTooManyRequests']);
