<?php

declare(strict_types=1);

namespace App\Dtos;

final class LoginDto
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
