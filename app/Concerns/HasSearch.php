<?php

declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 */
trait HasSearch
{
    /**
     * @param  Builder<TModel>  $query
     * @return Builder<TModel>
     */
    protected function scopeSearch(Builder $query, string $searchText): Builder
    {
        $searchParams = $this->getSearchableFields();
        foreach ($searchParams as $field) {
            $query->orWhere($field, 'LIKE', "%$searchText%");
        }

        return $query;
    }
}
