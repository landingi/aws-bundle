<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Queue;

use Landingi\AwsBundle\Aws\Sqs\Delay;
use PHPUnit\Framework\TestCase;

final class MemoryQueueClientTest extends TestCase
{
    public function testItSendsMessage(): void
    {
        $queue = new MemoryQueueClient();
        $queue->sendMessage(new MemoryMessage([]), new Delay(0));

        self::assertEquals(1, $queue->count());
    }
}
