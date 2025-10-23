<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Enums\OtpChannel;
use App\Models\User;

interface OtpChannelInterface
{
    public function send(User $user, string $otp): void;

    public function getChannel(): OtpChannel;
}
