<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Contracts\OtpChannelInterface;
use App\Contracts\Repositories\OtpRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\VerifyOtpDto;
use App\Enums\OtpContext;
use App\Exceptions\InvalidOtpException;
use App\Exceptions\OtpAlreadyRequestedException;
use App\Models\User;
use Illuminate\Support\Str;
use Random\RandomException;
use Symfony\Component\HttpFoundation\Response;

final readonly class OtpService
{
    public function __construct(
        private OtpRepositoryInterface $otpRepository,
        private OtpChannelInterface $otpChannel,
        private UserRepositoryInterface $userRepository,
    ) {}

    /**
     * Generate and send a new OTP token.
     *
     * @throws RandomException
     * @throws OtpAlreadyRequestedException
     */
    public function generateOtp(User $user, OtpContext $context): string
    {
        $this->ensureNoActiveOtp($user, $context);

        $otp = $this->generateOtpCode();
        $hashedOtp = $this->hashOtp($otp);
        $token = $this->generateToken();

        $this->otpRepository->store(
            user: $user,
            otp: $hashedOtp,
            token: $token,
            context: $context,
            otpChannel: $this->otpChannel->getChannel()
        );

        $this->otpChannel->send($user, $otp);

        return $token;
    }

    /**
     * Verify the OTP token.
     *
     * @throws InvalidOtpException
     */
    public function verifyOtp(VerifyOtpDto $dto): User
    {
        $hashedOtp = $this->hashOtp($dto->otp);

        $userId = $this->otpRepository->verify(
            $dto->token,
            $hashedOtp,
            $dto->otpContext
        );

        throw_if(is_null($userId), $this->invalidOtpException());

        $user = $this->userRepository->findById($userId);

        throw_if(is_null($user), $this->invalidOtpException());

        return $user;
    }

    private function invalidOtpException(): InvalidOtpException
    {
        /** @var string $message */
        $message = __('auth.invalid_otp');

        return new InvalidOtpException(
            message: $message,
            code: Response::HTTP_UNPROCESSABLE_ENTITY
        );
    }

    /**
     * Ensure that there is no valid OTP for the user and context.
     *
     * @throws OtpAlreadyRequestedException
     */
    private function ensureNoActiveOtp(User $user, OtpContext $context): void
    {
        if ($this->otpRepository->hasValidOtp($user, $context)) {
            /** @var string $message */
            $message = __('auth.already_requested');
            throw new OtpAlreadyRequestedException(
                message: $message,
                code: Response::HTTP_TOO_MANY_REQUESTS
            );
        }
    }

    /**
     * Generate a secure 6-digit OTP.
     *
     * @throws RandomException
     */
    private function generateOtpCode(): string
    {
        return (string) random_int(100000, 999999);
    }

    /**
     * Generate a unique token for OTP verification.
     */
    private function generateToken(): string
    {
        return Str::random(60);
    }

    /**
     * Hash the OTP if configuration requires it.
     */
    private function hashOtp(string $otp): string
    {
        return config('otp.hash_otp', true) ? hash('sha256', $otp) : $otp;
    }
}
