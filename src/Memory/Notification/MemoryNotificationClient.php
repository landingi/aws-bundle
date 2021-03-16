<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Notification;

use Countable;
use Landingi\AwsBundle\Notification\Message;
use Landingi\AwsBundle\Notification\NotificationClient;
use function count;

final class MemoryNotificationClient implements NotificationClient, Countable
{
    private array $memory = [];

    public function publish(Message $message): void
    {
        $this->memory[] = $message;
    }

    public function count(): int
    {
        return count($this->memory);
    }
}
