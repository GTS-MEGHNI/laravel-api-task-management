<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Enums\NotificationType;
use Illuminate\Notifications\Notification;

abstract class DatabaseNotification extends Notification
{
    abstract protected function getTitle(): string;

    abstract protected function getBody(): string;

    abstract protected function getType(): NotificationType;

    abstract protected function getSubjectId(): int;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    final public function via(): array
    {
        return ['database'];
    }

    /**
     * @return array<string, mixed>
     */
    final public function toDatabase(): array
    {
        return [
            'title' => $this->getTitle(),
            'body' => $this->getBody(),
            'type' => $this->getType(),
            'targetId' => $this->getSubjectId(),
        ];
    }
}
