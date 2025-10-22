<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Contracts\DtoTransformable;
use App\Dtos\RegisterDto;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

/**
 * @implements DtoTransformable<RegisterDto>
 */
final class RegisterRequest extends BaseRequest implements DtoTransformable
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, list<string|ValidationRule>>
     */
    public function rules(): array
    {
        /** @var array<string, list<string|ValidationRule>> $rules */
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class, 'email')],
            'phone' => ['required', 'string', 'max:255', Rule::unique(User::class, 'phone')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        return $rules;
    }

    public function toDto(): RegisterDto
    {
        /**
         * @var array{
         *     name: string,
         *     email: string,
         *     phone: string,
         *     password: string
         * } $validated
         */
        $validated = $this->validated();
        $name = $validated['name'];
        $email = $validated['email'];
        $phone = $validated['phone'];
        $password = $validated['password'];

        return new RegisterDto(
            name: $name,
            email: $email,
            phone: $phone,
            password: $password,
        );
    }
}
