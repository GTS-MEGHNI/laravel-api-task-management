<?php

declare(strict_types=1);

use App\Http\Responses\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Illuminate\Http\Request $request): bool {
            if ($request->is('api/*')) {
                return true;
            }

            return $request->expectsJson();
        });
        $exceptions->render(fn (ThrottleRequestsException $e): JsonResponse => ApiResponse::tooManyRequests());
        $exceptions->render(fn (NotFoundHttpException $e): JsonResponse => ApiResponse::notFound());
        $exceptions->render(fn (AuthenticationException $e): JsonResponse => ApiResponse::notFound());
        $exceptions->render(fn (ValidationException $e): JsonResponse => ApiResponse::validationErrors(
            errors: $e->errors(),
            message: $e->getMessage(),
        ));
        $exceptions->render(function (Exception|Error|Throwable $e): JsonResponse {
            if (app()->isProduction()) {
                return ApiResponse::internalError();
            }

            return ApiResponse::error(
                errors: [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );
        });
    })->create();
