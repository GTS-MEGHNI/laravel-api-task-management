<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\RegisterRequest;
use App\Services\Auth\RegisterService;

final class RegisterController
{
    public function __invoke(RegisterRequest $request, RegisterService $registerService): void
    {
        $registerService->register($request->toDto());
    }
}
