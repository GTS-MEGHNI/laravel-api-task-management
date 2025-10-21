<?php

declare(strict_types=1);

namespace App\Services;

use App\Dtos\FilterDto;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class UserService
{
    public function __construct(private UserRepository $userRepository) {}

    /**
     * @return LengthAwarePaginator<int, User>
     */
    public function getPaginated(FilterDto $filterDto): LengthAwarePaginator
    {
        return $this->userRepository->getPaginated($filterDto);
    }
}
