<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Contracts\OtpChannelInterface;
use App\Contracts\Repositories\OtpRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Str;
use Random\RandomException;

final readonly class OtpService
{
    public function __construct(
        private OtpRepositoryInterface $otpRepository,
        private OtpChannelInterface $otpChannel
    ) {}

    /**
     * @throws RandomException
     */
    public function getOtpToken(User $user): string
    {
        $otp = (string) random_int(100000, 999999);
        $shouldHashOtp = config('otp.hash_otp', true);
        if ($shouldHashOtp) {
            $otp = hash('sha256', $otp);
        }
        $token = Str::random(60);
        $this->otpRepository->store($user, $token, $otp, $this->otpChannel->getChannel());
        $this->otpChannel->send($user, $otp);

        return $token;
    }
}
