<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\OtpRepositoryInterface;
use App\Enums\OtpChannel;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

final class CacheOtpRepository implements OtpRepositoryInterface
{
    private int $ttl = 600;

    public function store(User $user, string $otp, string $token, OtpChannel $channel): void
    {
        Cache::put("otp:$token", [
            'user_id' => $user->id,
            'otp' => $otp,
            'channel' => $channel,
        ], $this->ttl);
    }

    public function verify(string $token, string $otp): bool
    {
        /** @var string|null $data */
        $data = Cache::get("otp:$token");
        if (! $data) {
            return false;
        }
        /**
         * @var array{
         *     user_id: int,
         *     hash: string,
         *     channel?: string
         * } $decoded
         */
        $decoded = json_decode($data, true);
        $hash = (string) $decoded['hash'];
        $isValid = hash_equals($hash, $otp);
        if ($isValid) {
            Cache::forget("otp:$token");
        }

        return $isValid;
    }
}
