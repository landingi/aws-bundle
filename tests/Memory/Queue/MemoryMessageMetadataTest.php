<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Queue;

use Landingi\AwsBundle\Queue\QueueException;
use PHPUnit\Framework\TestCase;

final class MemoryMessageMetadataTest extends TestCase
{
    public function testItSerializes(): void
    {
        self::assertEquals(0, (new MemoryMessageMetadata(0))->getDelay());
        self::assertEquals(1, (new MemoryMessageMetadata(1))->getDelay());
        self::assertEquals(200, (new MemoryMessageMetadata(200))->getDelay());
    }

    public function testItThrowsExceptionForInvalidMetadata(): void
    {
        $this->expectException(QueueException::class);
        new MemoryMessageMetadata(-1);
    }
}
