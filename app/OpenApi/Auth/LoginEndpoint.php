<?php

declare(strict_types=1);

namespace App\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/login',
    description: 'Authenticate a user and return an access token.',
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
                    new OA\Property(property: 'token', type: 'string', example: 'eyJ0eXAiOiJKV1QiLCJh...'),
                ]
            )
        ),
        new OA\Response(response: 401, description: 'Invalid credentials'),
    ]
)]
final readonly class LoginEndpoint {}
