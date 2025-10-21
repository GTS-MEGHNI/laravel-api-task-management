<?php

declare(strict_types=1);

namespace App\Contracts;

/**
 * @template T of object
 */
interface DtoTransformable
{
    /**
     * @return T
     */
    public function toDto(): object;
}
