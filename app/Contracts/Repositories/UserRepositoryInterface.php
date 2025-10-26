<?php

declare(strict_types=1);

namespace App\Contracts\Repositories;

use App\Dtos\RegisterDto;
use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;

    public function findById(int $id): ?User;

    public function create(RegisterDto $data): User;
}
