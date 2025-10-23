<?php

declare(strict_types=1);

namespace App\Services\Auth\OtpChannels;

use App\Contracts\OtpChannelInterface;
use App\Enums\OtpChannel;
use App\Models\User;
use App\Notifications\SendOtpNotification;

final class EmailOtpChannel implements OtpChannelInterface
{
    public function send(User $user, string $otp): void
    {
        $user->notify(new SendOtpNotification($otp));
    }

    public function getChannel(): OtpChannel
    {
        return OtpChannel::Email;
    }
}
