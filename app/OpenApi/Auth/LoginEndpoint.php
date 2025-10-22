<?php

declare(strict_types=1);

namespace App\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/v1/auth/login',
    description: 'Authenticate a user using email and password and return an access token.',
    summary: 'User login',
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['email', 'password'],
            properties: [
                new OA\Property(property: 'email', type: 'string', example: 'user@example.com'),
                new OA\Property(property: 'password', type: 'string', format: 'password', example: 'secret123'),
            ]
        )
    ),
    tags: ['Auth'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Login successful',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Success'),
                    new OA\Property(
                        property: 'data',
                        properties: [
                            new OA\Property(
                                property: 'token',
                                type: 'string',
                                example: '3|ZmfpLMXPVFnmtXhBcPQzctJ9bKmkO3cNCnu45lffa1448642'
                            ),
                        ],
                        type: 'object'
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
            response: 422,
            description: 'Validation error',
            content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
        ),

        new OA\Response(
            response: 500,
            description: 'Internal server error',
            content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
        ),
    ]
)]
final readonly class LoginEndpoint {}
