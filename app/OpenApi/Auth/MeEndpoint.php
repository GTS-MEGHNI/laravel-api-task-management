<?php

declare(strict_types=1);

namespace App\OpenApi\Auth;

namespace App\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/api/v1/auth/me',
    description: 'Return the currently authenticated user based on the provided access token.',
    summary: 'Get authenticated user',
    security: [['bearerAuth' => []]],
    tags: ['Auth'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Authenticated user retrieved successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Success'),
                    new OA\Property(
                        property: 'data',
                        ref: '#/components/schemas/User'
                    ),
                ]
            )
        ),

        new OA\Response(
            response: 401,
            description: 'Unauthorized — missing or invalid token.',
            content: new OA\JsonContent(ref: '#/components/schemas/UnauthorizedResponse')
        ),

        new OA\Response(
            response: 500,
            description: 'Internal server error',
            content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
        ),
    ]
)]
final readonly class MeEndpoint {}
