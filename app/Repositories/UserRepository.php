<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Builder\UserBuilder;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\FilterDto;
use App\Dtos\RegisterDto;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

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

    public function create(RegisterDto $data): User
    {
        return User::query()->create([
            'email' => $data->email,
            'phone' => $data->phone,
            'password' => Hash::make($data->password),
            'name' => $data->name,
        ]);
    }

    public function findById(int $id): ?User
    {
        return User::query()->where(['id' => $id])->first();
    }
}
