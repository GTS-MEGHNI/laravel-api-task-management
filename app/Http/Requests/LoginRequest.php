<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Contracts\DtoTransformable;
use App\Dtos\LoginDto;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

/**
 * @implements DtoTransformable<LoginDto>
 */
final class LoginRequest extends BaseRequest implements DtoTransformable
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): true
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, list<ValidationRule|string>>
     */
    public function rules(): array
    {
        /** @var array<string, list<ValidationRule|string>> $rules */
        $rules = [
            'email' => ['required', 'email', Rule::exists(User::class, 'email')],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ];

        return $rules;
    }

    public function toDto(): LoginDto
    {
        /** @var array{email: string, password: string} $validated */
        $validated = $this->validated();
        $email = $validated['email'];
        $password = $validated['password'];

        return new LoginDto(
            email: $email,
            password: $password
        );
    }
}
