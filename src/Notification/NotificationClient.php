<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Notification;

interface NotificationClient
{
    public function publish(Message $message): void;
}
