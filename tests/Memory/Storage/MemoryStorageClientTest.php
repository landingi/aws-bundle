<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Storage;

use PHPUnit\Framework\TestCase;

final class MemoryStorageClientTest extends TestCase
{
    public function testItGets(): void
    {
        $storage = new MemoryStorageClient();
        $storage->put(new MemoryFile('name', 'content'));

        self::assertEquals('content', $storage->get('name')->getContent());
    }

    public function testItPuts(): void
    {
        $storage = new MemoryStorageClient();
        $storage->put(new MemoryFile('name', 'content'));

        self::assertEquals(1, $storage->count());
    }
}
