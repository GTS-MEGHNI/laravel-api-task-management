<?php

declare(strict_types=1);

use App\Http\Responses\ApiResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

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
        $exceptions->shouldRenderJsonWhen(function (Request $request): bool {
            if ($request->is('api/*')) {
                return true;
            }

            return $request->expectsJson();
        });
        $exceptions->render(ApiResponse::tooManyRequests(...));
        $exceptions->render(ApiResponse::notFound(...));
        $exceptions->render(ApiResponse::unauthorized(...));
        $exceptions->render(function (ValidationException $e): JsonResponse {
            /** @var array<string, mixed> $errors */
            $errors = $e->errors();

            return ApiResponse::validationErrors(
                errors: $errors,
                message: $e->getMessage(),
            );
        });
        $exceptions->render(function (Exception|Error|Throwable $e): JsonResponse {
            if (app()->isProduction()) {
                return ApiResponse::internalError();
            }

            return ApiResponse::error(
                code: Response::HTTP_INTERNAL_SERVER_ERROR,
                errors: [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );
        });
    })->create();
