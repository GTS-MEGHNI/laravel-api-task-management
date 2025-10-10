<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

final class ApiResponse
{
    /**
     * @param  JsonResource|ResourceCollection|array<string, mixed>|null  $data
     * @param  array<string, mixed>  $meta
     */
    public static function success(
        JsonResource|ResourceCollection|array|null $data = null,
        string $message = 'Success',
        int $code = Response::HTTP_OK,
        array $meta = []
    ): JsonResponse {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        if ($meta !== []) {
            $response['meta'] = $meta;
        }

        return new JsonResponse($response, $code);
    }

    /**
     * @param  array<string, mixed>  $errors
     */
    public static function error(
        string $message = 'Error occurred',
        int $code = Response::HTTP_BAD_REQUEST,
        array $errors = []
    ): JsonResponse {
        $response = [
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ];

        return new JsonResponse($response, $code);
    }

    public static function notFound(string $message = 'Resource Not Found'): JsonResponse
    {
        return self::error($message, Response::HTTP_NOT_FOUND);
    }

    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return self::error($message, Response::HTTP_UNAUTHORIZED);
    }

    public static function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return self::error($message, Response::HTTP_FORBIDDEN);
    }

    public static function internalError(string $message = 'Internal Server Error'): JsonResponse
    {
        return self::error($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public static function noContent(): Response
    {
        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param  JsonResource|ResourceCollection|array<string, mixed>|null  $data
     */
    public static function created(
        JsonResource|ResourceCollection|array|null $data = null,
        string $message = 'Created'
    ): JsonResponse {
        return self::success($data, $message, Response::HTTP_CREATED);
    }

    /**
     * @param  ResourceCollection|array<string, mixed>  $data
     */
    public static function withPagination(
        LengthAwarePaginator $paginator,
        ResourceCollection|array $data,
        string $message = 'Success'
    ): JsonResponse {
        $meta = [
            'pagination' => [
                'total' => $paginator->total(),
                'count' => $paginator->count(),
                'perPage' => $paginator->perPage(),
                'currentPage' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
            ],
        ];

        return self::success($data, $message, Response::HTTP_OK, $meta);
    }

    /**
     * @param  array<string, mixed>  $errors
     */
    public static function validationErrors(
        array $errors = [],
        string $message = 'Validation Error'
    ): JsonResponse {
        return self::error($message, Response::HTTP_UNPROCESSABLE_ENTITY, $errors);
    }

    public static function methodNotAllowed(string $message = 'Method Not Allowed'): JsonResponse
    {
        return self::error($message, Response::HTTP_METHOD_NOT_ALLOWED);
    }

    public static function tooManyRequests(string $message = 'Too Many Requests'): JsonResponse
    {
        return self::error($message, Response::HTTP_TOO_MANY_REQUESTS);
    }
}
