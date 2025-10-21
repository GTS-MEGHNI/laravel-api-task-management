<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Contracts\DtoTransformable;
use App\Dtos\FilterDto;

/**
 * @implements DtoTransformable<FilterDto>
 */
final class UserIndexRequest extends BaseRequest implements DtoTransformable
{
    /**
     * @return array<string, array<string>>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'perPage' => ['nullable', 'integer', 'min:1', 'max:100'],
            'sortBy' => ['nullable', 'string', 'in:id,name,email,created_at'],
            'sortDirection' => ['nullable', 'string', 'in:asc,desc'],
        ];
    }

    public function toDto(): FilterDto
    {
        /**
         * @var array{
         *     search: string|null,
         *     sortBy: string,
         *     sortDirection: string,
         *     perPage: int
         * } $validated
         */
        $validated = $this->validated();
        $search = $validated['search'];
        $sortBy = $validated['sortBy'];
        $sortDirection = $validated['sortDirection'];
        $perPage = $validated['perPage'];

        return new FilterDto(
            search: $search,
            perPage: $perPage,
            sortBy: $sortBy,
            sortDirection: $sortDirection,
        );
    }
}
