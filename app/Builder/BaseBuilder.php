<?php

declare(strict_types=1);

namespace App\Builder;

use App\Contracts\Searchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @template TModel of Model
 *
 * @extends Builder<TModel>
 */
abstract class BaseBuilder extends Builder
{
    /**
     * @return Builder<Model>
     */
    final public function search(string $searchText): Builder
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
        /** @var Searchable $model */
        $model = $this->getModel();

        return $model->getSearchableFields();
    }
}
