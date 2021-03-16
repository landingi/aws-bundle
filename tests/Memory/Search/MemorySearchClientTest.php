<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Search;

use Landingi\AwsBundle\Search\Document;
use Landingi\AwsBundle\Search\DocumentIdentifier;
use PHPUnit\Framework\TestCase;

final class MemorySearchClientTest extends TestCase
{
    public function testItUploadsDocument(): void
    {
        $search = new MemorySearchClient();
        $search->upload(new Document(new DocumentIdentifier('id')));

        self::assertEquals(1, $search->count());
    }

    public function testItUploadsMultipleDocuments(): void
    {
        $search = new MemorySearchClient();
        $search->upload(
            new Document(new DocumentIdentifier('id1')),
            new Document(new DocumentIdentifier('id2'))
        );

        self::assertEquals(2, $search->count());
    }

    public function testItDeletesDocument(): void
    {
        $search = new MemorySearchClient();
        $search->delete(new DocumentIdentifier('id'));

        self::assertEquals(0, $search->count());
    }
}
