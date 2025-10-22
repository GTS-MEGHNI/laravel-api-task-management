<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\RegisterDto;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\DB;
use Throwable;

final readonly class RegisterService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    /**
     * @throws Throwable
     */
    public function register(RegisterDto $data): void
    {
        DB::transaction(function () use ($data): void {
            $user = $this->userRepository->create($data);

            UserRegistered::dispatch($user);
        });
    }
}
