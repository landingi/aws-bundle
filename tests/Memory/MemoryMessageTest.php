<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory;

use PHPUnit\Framework\TestCase;

final class MemoryMessageTest extends TestCase
{
    public function testItSerializes(): void
    {
        self::assertEquals([], (new MemoryMessage([]))->jsonSerialize());
        self::assertEquals(['key'], (new MemoryMessage(['key']))->jsonSerialize());
        self::assertEquals(['key' => 'value'], (new MemoryMessage(['key' => 'value']))->jsonSerialize());
        self::assertEquals(['key' => ['value', 'value']], (new MemoryMessage(['key' => ['value', 'value']]))->jsonSerialize());
    }

    public function testItGetsBody(): void
    {
        self::assertEquals([], (new MemoryMessage([]))->getBody());
        self::assertEquals(['key'], (new MemoryMessage(['key']))->getBody());
        self::assertEquals(['key' => 'value'], (new MemoryMessage(['key' => 'value']))->getBody());
        self::assertEquals(['key' => ['value', 'value']], (new MemoryMessage(['key' => ['value', 'value']]))->getBody());
    }
}
