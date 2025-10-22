<?php

declare(strict_types=1);

namespace App\Dtos;

final class RegisterDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $phone,
        public string $password
    ) {}

}
