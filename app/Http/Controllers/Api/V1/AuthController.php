<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\LoginFailedException;
use App\Http\Requests\LoginRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Auth\LoginService;
use Illuminate\Http\JsonResponse;

final readonly class AuthController
{
    public function __construct(private LoginService $loginService) {}

    /**
     * @throws LoginFailedException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $payload = $request->toDto();
        $token = $this->loginService->execute($payload);

        return ApiResponse::success($token);
    }
}
