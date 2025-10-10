<?php

/** @noinspection PhpUnused */

declare(strict_types=1);

namespace App\Notifications;

use App\Enums\NotificationType;

final class MockDatabaseNotification extends DatabaseNotification
{
    protected function getTitle(): string
    {
        return 'Title';
    }

    protected function getBody(): string
    {
        return 'Body Content';
    }

    protected function getType(): NotificationType
    {
        return NotificationType::Database;
    }

    protected function getSubjectId(): int
    {
        return 1;
    }
}
