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
        $searchParams = new User()->getSearchableFields();
        foreach ($searchParams as $field) {
            $this->orWhere($field, 'LIKE', "%$searchText%");
        }

        return $this;
    }
}
