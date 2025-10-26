<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\InvalidOtpException;
use App\Http\Requests\VerifyAccountActivationOtpRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Auth\OtpService;
use Illuminate\Http\JsonResponse;

final readonly class OtpAccountActivationController
{
    public function __construct(
        private OtpService $otpService
    ) {}

    //

    /**
     * @throws InvalidOtpException
     */
    public function verify(VerifyAccountActivationOtpRequest $request): JsonResponse
    {
        $payload = $request->toDto();
        $user = $this->otpService->verifyOtp($payload);
        $token = $user->createToken('bearer_token')->plainTextToken;

        return ApiResponse::success([
            'token' => $token,
        ]);
    }
}
