<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\LoginDto;
use App\Exceptions\LoginFailedException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

final readonly class LoginService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    /**
     * @return array<string, string>
     *
     * @throws LoginFailedException
     */
    public function execute(LoginDto $payload): array
    {
        $user = $this->userRepository->findByEmail($payload->email);
        if (! $user instanceof User || ! Hash::check($payload->password, $user->password)) {
            $message = __('auth.failed');
            assert(is_string($message));
            throw new LoginFailedException(
                message: $message,
                code: Response::HTTP_UNAUTHORIZED
            );
        }

        $token = $user->createToken('bearer_token')->plainTextToken;

        return [
            'token' => $token,
        ];
    }
}
