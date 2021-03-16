<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Notification;

use PHPUnit\Framework\TestCase;

final class MemoryNotificationClientTest extends TestCase
{
    public function testItPublishes(): void
    {
        $notifier = new MemoryNotificationClient();
        $notifier->publish(new MemoryMessage([]));

        self::assertEquals(1, $notifier->count());
    }
}
