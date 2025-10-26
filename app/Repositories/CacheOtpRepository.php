<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\OtpRepositoryInterface;
use App\Enums\OtpChannel;
use App\Enums\OtpContext;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;

final class CacheOtpRepository implements OtpRepositoryInterface
{
    private int $ttl = 600;

    public function store(User $user, string $otp, string $token, OtpContext $context, OtpChannel $otpChannel): void
    {
        $cacheKey = $this->tokenKey($token);
        $indexKey = $this->indexKey($user, $context);
        Cache::put($cacheKey, [
            'token' => $token,
            'otp' => $otp,
            'user_id' => $user->id,
            'context' => $context->value,
            'channel' => $otpChannel->value,
            'expires_at' => now()->addSeconds($this->ttl)->timestamp,
        ], $this->ttl);
        Cache::put($indexKey, $token, $this->ttl);
    }

    public function verify(string $token, string $otp, OtpContext $context): ?int
    {
        $cacheKey = $this->tokenKey($token);
        /**
         * @var array{
         *     token: string,
         *     otp: string,
         *     user_id: int,
         *     context: string,
         *     channel: string,
         *     expires_at: int
         * }|null $data
         */
        $data = Cache::get($cacheKey);

        if (! $data) {
            return null;
        }

        $expiresAt = Date::createFromTimestamp($data['expires_at']);

        // Single boolean for all validation
        $isValid = Date::now()->lessThanOrEqualTo($expiresAt)
            && ($data['context'] === $context->value)
            && hash_equals((string) $data['otp'], $otp);

        if ($isValid) {
            Cache::forget($cacheKey); // Invalidate OTP after successful verification
        }

        return $data['user_id'];
    }

    public function hasValidOtp(User $user, OtpContext $context): bool
    {
        return Cache::has($this->indexKey($user, $context));
    }

    private function tokenKey(string $token): string
    {
        return "otp:$token";
    }

    private function indexKey(User $user, OtpContext $context): string
    {
        return "otp_index:$context->value:$user->id";
    }
}
