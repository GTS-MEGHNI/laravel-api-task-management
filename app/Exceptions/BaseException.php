<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

abstract class BaseException extends Exception
{
    final public function render(): JsonResponse
    {
        $code = $this->getCode();

        return ApiResponse::error($this->message, $code, [
            'trace' => $this->getTrace(),
            'message' => $this->getMessage(),
        ]);
    }
}
