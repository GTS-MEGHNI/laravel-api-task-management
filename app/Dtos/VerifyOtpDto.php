<?php

declare(strict_types=1);

namespace App\Dtos;

use App\Enums\OtpContext;

final class VerifyOtpDto
{
    public function __construct(
        public string $token,
        public string $otp,
        public OtpContext $otpContext,
    ) {}

}
