<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Queue;

use PHPUnit\Framework\TestCase;

final class MemoryQueueClientTest extends TestCase
{
    public function testItSendsMessage(): void
    {
        $queue = new MemoryQueueClient();
        $queue->sendMessage(new MemoryMessage([]), new MemoryMessageMetadata(0));

        self::assertEquals(1, $queue->count());
    }
}
