<?php

declare(strict_types=1);

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'API documentation for my Laravel 12 project',
    title: 'My Laravel API'
)]
#[OA\Server(
    url: 'http://localhost:8000',
    description: 'Local development server'
)]
final class OpenApiDefinition {}
