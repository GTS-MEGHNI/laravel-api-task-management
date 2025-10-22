<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ErrorResponse',
    description: 'Standard error response format',
    properties: [
        new OA\Property(property: 'success', type: 'boolean', example: false),
        new OA\Property(property: 'message', type: 'string', example: 'An unexpected error occurred. Please try again later.'),
        new OA\Property(
            property: 'errors',
            type: 'object',
            example: []
        ),
    ],
    type: 'object'
)]
final class ErrorResponseSchema {}
