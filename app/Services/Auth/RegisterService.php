<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\RegisterDto;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class RegisterService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private OtpService $otpService,
    ) {}

    /**
     * @throws Throwable
     */
    public function register(RegisterDto $data): string
    {
        /** @var User $user */
        $user = DB::transaction(fn (): User => $this->userRepository->create($data));

        return $this->otpService->getOtpToken($user);
    }
}
