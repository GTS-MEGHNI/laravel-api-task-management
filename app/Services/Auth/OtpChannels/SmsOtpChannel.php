<?php

declare(strict_types=1);

namespace App\Services\Auth\OtpChannels;

use App\Contracts\OtpChannelInterface;
use App\Enums\OtpChannel;
use App\Models\User;
use Illuminate\Support\Facades\Log;

final class SmsOtpChannel implements OtpChannelInterface
{
    public function send(User $user, string $otp): void
    {
        Log::info("Sending OTP $otp to user $user->phone via SMS.");
    }

    public function getChannel(): OtpChannel
    {
        return OtpChannel::Sms;
    }
}
