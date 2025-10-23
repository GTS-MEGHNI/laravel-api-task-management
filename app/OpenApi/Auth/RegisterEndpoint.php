<?php

declare(strict_types=1);

namespace App\OpenApi\Auth;

use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/v1/auth/register',
    description: 'Create a new user account and return an OTP token for verification.',
    summary: 'Register a new user',
    requestBody: new OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            required: ['email', 'password', 'password_confirmation', 'name', 'phone'],
            properties: [
                new OA\Property(property: 'email', type: 'string', format: 'email', example: 'eltfng2@example.net'),
                new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password'),
                new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'password'),
                new OA\Property(property: 'name', type: 'string', example: 'Mohamed El Amine'),
                new OA\Property(property: 'phone', type: 'string', example: '0561955770'),
            ]
        )
    ),
    tags: ['Auth'],
    responses: [
        // ✅ Success
        new OA\Response(
            response: 200,
            description: 'Registration successful, OTP token returned',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'success', type: 'boolean', example: true),
                    new OA\Property(property: 'message', type: 'string', example: 'Success'),
                    new OA\Property(
                        property: 'data',
                        properties: [
                            new OA\Property(property: 'otpToken', type: 'string', example: 'LErLhDAndpIoUm5UkqbaKGBEYqHGCRq6r8yGYoRL0JDPjGm9TDsxAqwv5IRz'),
                        ],
                        type: 'object'
                    ),
                ]
            )
        ),

        // ⚠️ Validation errors (422)
        new OA\Response(
            response: 422,
            description: 'Validation error',
            content: new OA\JsonContent(ref: '#/components/schemas/ValidationErrorResponse')
        ),

        // 💥 Server error (500)
        new OA\Response(
            response: 500,
            description: 'Internal server error',
            content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
        ),
    ]
)]
final readonly class RegisterEndpoint {}
