<?php

/** @noinspection PhpPluralMixedCanBeReplacedWithArrayInspection */

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

abstract class ApiController
{
    /**
     * @param  array<string, mixed>  $meta
     */
    protected function respondSuccess(JsonResource|ResourceCollection $data, string $message = 'Success', int $code = Response::HTTP_OK, array $meta = []): JsonResponse
    {
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
    protected function respondError(string $message = 'Error occurred', int $code = Response::HTTP_BAD_REQUEST, array $errors = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ];

        return new JsonResponse($response, $code);
    }

    protected function respondNotFound(string $message = 'Resource Not found', int $code = Response::HTTP_NOT_FOUND): JsonResponse
    {
        return $this->respondError($message, $code);
    }

    protected function respondUnauthorized(string $message = 'Unauthorized', int $code = Response::HTTP_UNAUTHORIZED): JsonResponse
    {
        return $this->respondError($message, $code);
    }

    protected function respondForbidden(string $message = 'Forbidden', int $code = Response::HTTP_FORBIDDEN): JsonResponse
    {
        return $this->respondError($message, $code);
    }

    protected function respondInternalError(string $message = 'Internal Server Error', int $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->respondError($message, $code);
    }

    protected function respondNoContent(int $code = Response::HTTP_NO_CONTENT): Response
    {
        return new Response(null, $code);
    }

    protected function respondCreated(JsonResource|ResourceCollection $data, string $message = 'Created', int $code = Response::HTTP_CREATED): Response
    {
        return $this->respondSuccess($data, $message, $code);
    }

    /**
     * @param  LengthAwarePaginator<int, array<string, mixed>>  $paginator
     */
    protected function respondWithPagination(LengthAwarePaginator $paginator, ResourceCollection $data, string $message = 'Success'): Response
    {
        $meta = [
            'pagination' => [
                'total' => $paginator->total(),
                'count' => $paginator->count(),
                'perPage' => $paginator->perPage(),
                'currentPage' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
            ],
        ];

        return $this->respondSuccess($data, $message, Response::HTTP_OK, $meta);
    }

    /**
     * @param  array<string, mixed>  $errors
     */
    protected function respondValidationErrors(array $errors = [], string $message = 'Validation Error', int $code = Response::HTTP_UNPROCESSABLE_ENTITY): Response
    {
        return $this->respondError($message, $code, $errors);
    }

    protected function respondMethodNotAllowed(string $message = 'Method Not Allowed', int $code = Response::HTTP_METHOD_NOT_ALLOWED): Response
    {
        return $this->respondError($message, $code);
    }

    protected function respondTooManyRequests(string $message = 'Too Many Requests', int $code = Response::HTTP_TOO_MANY_REQUESTS): Response
    {
        return $this->respondError($message, $code);
    }
}
