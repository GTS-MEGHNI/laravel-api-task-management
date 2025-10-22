<?php

declare(strict_types=1);

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UnauthorizedResponse',
    description: 'Unauthorized error response — returned when credentials or token are invalid.',
    properties: [
        new OA\Property(property: 'success', type: 'boolean', example: false),
        new OA\Property(property: 'message', type: 'string', example: 'Unauthenticated.'),
        new OA\Property(
            property: 'errors',
            type: 'array',
            items: new OA\Items(type: 'string'),
            example: []
        ),
    ],
    type: 'object'
)]
final readonly class UnauthorizedResponseSchema {}
