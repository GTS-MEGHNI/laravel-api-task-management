<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Contracts\DtoTransformable;
use App\Dtos\SendOtpDto;
use App\Enums\OtpContext;
use App\Models\User;
use Illuminate\Validation\Rule;
use Stringable;

/**
 * @implements DtoTransformable<SendOtpDto>
 */
final class SendOtpRequest extends BaseRequest implements DtoTransformable
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, list<Stringable|string>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::exists(User::class, 'email')],
            'context' => ['required', 'string', Rule::in(OtpContext::cases())],
        ];
    }

    public function toDto(): object
    {
        /** @var array{email: string, context:string} $validated */
        $validated = $this->validated();
        $email = $validated['email'];
        $context = OtpContext::from($validated['context']);

        return new SendOtpDto(
            email: $email,
            otpContext: $context,
        );
    }
}
