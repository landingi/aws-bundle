<?php
declare(strict_types=1);

namespace Landingi\Core\Notification;

interface NotificationClient
{
    public function publish(Message $message): void;
}
