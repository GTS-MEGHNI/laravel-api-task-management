<?php

declare(strict_types=1);

namespace App\Dtos;

use App\Enums\OtpContext;

final class SendOtpDto
{
    public function __construct(
        public string $email,
        public OtpContext $otpContext
    ) {}

}
