<?php

declare(strict_types=1);

namespace App\Contracts;

interface Searchable
{
    /**
     * @return array<int, string>
     */
    public function getSearchableFields(): array;
}
