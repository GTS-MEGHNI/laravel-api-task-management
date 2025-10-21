<?php

declare(strict_types=1);

namespace App\Builder;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModel of User
 *
 * @extends Builder<TModel>
 */
final class UserBuilder extends Builder
{
    /**
     * @return Builder<User>
     */
    public function search(string $searchText): Builder
    {
        $searchParams = $this->getSearchableFields();
        foreach ($searchParams as $field) {
            $this->orWhere($field, 'LIKE', "%$searchText%");
        }

        return $this;
    }

    /**
     * @return array<int, string>
     */
    private function getSearchableFields(): array
    {
        return [
            'name',
            'email',
        ];
    }
}
