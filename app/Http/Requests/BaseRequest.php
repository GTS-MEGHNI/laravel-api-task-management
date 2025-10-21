<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Responses\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        /** @var array<string, mixed> $errors */
        $errors = $validator->errors()->toArray();
        throw new HttpResponseException(
            response: ApiResponse::validationErrors(
                $errors,
                $validator->errors()->first()
            )
        );
    }
}
