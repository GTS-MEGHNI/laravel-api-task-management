<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\LoginFailedException;
use App\Http\Requests\LoginRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class AuthController
{
    /**
     * @throws LoginFailedException
     */
    public function login(LoginRequest $request, LoginService $service): JsonResponse
    {
        $payload = $request->toDto();
        $token = $service->execute($payload);

        return ApiResponse::success($token);
    }

    public function getAuthUser(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();

        return ApiResponse::success($user->toResource());
    }

    public function logout(Request $request): Response
    {
        /** @var User $user */
        $user = $request->user();
        $user->tokens()->delete();

        return ApiResponse::noContent();
    }
}
