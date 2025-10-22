<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ValidationErrorResponse',
    description: 'Validation error response format',
    properties: [
        new OA\Property(property: 'success', type: 'boolean', example: false),
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'The email field must be a valid email address.'
        ),
        new OA\Property(
            property: 'errors',
            type: 'object',
            example: [
                'email' => ['The email field must be a valid email address.'],
            ],
        ),
    ],
    type: 'object'
)]
final readonly class ValidationErrorResponseSchema {}
