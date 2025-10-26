<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Contracts\DtoTransformable;
use App\Dtos\VerifyOtpDto;
use App\Enums\OtpContext;

/**
 * @implements DtoTransformable<VerifyOtpDto>
 */
final class VerifyAccountActivationOtpRequest extends BaseRequest implements DtoTransformable
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, list<string>>
     */
    public function rules(): array
    {
        return [
            'token' => ['required', 'string'],
            'otp' => ['required', 'string'],
        ];
    }

    public function toDto(): VerifyOtpDto
    {
        /** @var array{ token: string, otp: string} $validated */
        $validated = $this->validated();
        $token = $validated['token'];
        $otp = $validated['otp'];

        return new VerifyOtpDto(
            token: $token,
            otp: $otp,
            otpContext: OtpContext::AccountActivation
        );
    }
}
