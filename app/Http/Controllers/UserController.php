<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserIndexRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use App\Services\UserService;

final class UserController
{
    public function index(UserIndexRequest $request, UserService $userService): \Illuminate\Http\JsonResponse
    {
        $payload = $request->toDto();
        $userPaginator = $userService->getPaginated($payload);

        return ApiResponse::withPagination(
            paginator: $userPaginator,
            data: UserResource::collection($userPaginator->items())
        );
    }
}
