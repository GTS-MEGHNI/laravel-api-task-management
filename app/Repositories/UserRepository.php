<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Builder\UserBuilder;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\FilterDto;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

final class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email): ?User
    {
        return User::query()->where(['email' => $email])->first();
    }

    /**
     * @return LengthAwarePaginator<int, User>
     */
    public function getPaginated(FilterDto $filterDto): LengthAwarePaginator
    {
        /** @var UserBuilder $query */
        $query = User::query();

        if ($filterDto->search !== null && $filterDto->search !== '') {
            $query->search($filterDto->search);
        }

        // Apply sorting
        $query->orderBy($filterDto->sortBy, $filterDto->sortDirection);

        // Paginate
        return $query->paginate($filterDto->perPage);
    }
}
