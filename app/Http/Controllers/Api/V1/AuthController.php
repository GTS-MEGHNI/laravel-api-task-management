<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;

final class AuthController
{
    public function login(LoginRequest $request): Response
    {
        $request->toDto();

        return response()->noContent();
    }
}
