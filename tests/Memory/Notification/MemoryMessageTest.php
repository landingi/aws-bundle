<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Notification;

use PHPUnit\Framework\TestCase;

final class MemoryMessageTest extends TestCase
{
    public function testItGetsBody(): void
    {
        self::assertEquals([], (new MemoryMessage([]))->getData());
        self::assertEquals(['key'], (new MemoryMessage(['key']))->getData());
        self::assertEquals(['key' => 'value'], (new MemoryMessage(['key' => 'value']))->getData());
        self::assertEquals(['key' => ['value', 'value']], (new MemoryMessage(['key' => ['value', 'value']]))->getData());
    }
}
