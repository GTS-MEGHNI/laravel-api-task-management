<?php

declare(strict_types=1);

namespace App\Dtos;

final class FilterDto
{
    public function __construct(
        public ?string $search,
        public int $perPage,
        public string $sortBy,
        public string $sortDirection,
    ) {}

}
