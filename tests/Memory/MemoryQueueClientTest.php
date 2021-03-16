<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

final class MemoryQueueClientTest extends TestCase
{
    public function testItSendsMessage(): void
    {
        $queue = new MemoryQueueClient();
        $queue->sendMessage(new MemoryMessage([]), new MemoryMessageMetadata(0));

        assertEquals(1, $queue->count());
    }
}
