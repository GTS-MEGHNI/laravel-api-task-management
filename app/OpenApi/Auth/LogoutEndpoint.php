<?php

declare(strict_types=1);

namespace App\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/v1/auth/logout',
    description: 'Invalidate the current access token and log the user out.',
    summary: 'User logout',
    security: [['bearerAuth' => []]],
    tags: ['Auth'],
    responses: [
        new OA\Response(
            response: 204,
            description: 'Logout successful. No content returned.'
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
final class LogoutEndpoint {}
