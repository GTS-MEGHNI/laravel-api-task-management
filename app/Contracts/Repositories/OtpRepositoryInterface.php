<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Enums\OtpChannel;
use App\Enums\OtpContext;
use App\Models\User;

interface OtpRepositoryInterface
{
    public function store(User $user, string $otp, string $token, OtpContext $context, OtpChannel $otpChannel): void;

    public function verify(string $token, string $otp, OtpContext $context): ?int;

    public function hasValidOtp(User $user, OtpContext $context): bool;
}
