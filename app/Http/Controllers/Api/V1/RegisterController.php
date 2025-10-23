<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\RegisterRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use Throwable;

final readonly class RegisterController
{
    public function __construct(private RegisterService $registerService) {}

    /**
     * @throws Throwable
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $token = $this->registerService->register($request->toDto());

        return ApiResponse::success([
            'otpToken' => $token,
        ]);
    }
}
