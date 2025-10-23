<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Enums\OtpChannel;
use App\Models\User;

interface OtpRepositoryInterface
{
    public function store(User $user, string $otp, string $token, OtpChannel $channel): void;

    public function verify(string $token, string $otp): bool;
}
