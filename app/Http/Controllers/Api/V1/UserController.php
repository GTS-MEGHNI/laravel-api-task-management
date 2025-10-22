<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\UserIndexRequest;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

final class UserController
{
    public function index(UserIndexRequest $request, UserService $userService): JsonResponse
    {
        $payload = $request->toDto();
        $userPaginator = $userService->getPaginated($payload);

        return ApiResponse::withPagination(
            paginator: $userPaginator,
            data: UserResource::collection($userPaginator->items())
        );
    }

    public function show(User $user): JsonResponse
    {
        return ApiResponse::success($user->toResource());
    }
}
