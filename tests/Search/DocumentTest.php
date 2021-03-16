<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Search;

use PHPUnit\Framework\TestCase;

final class DocumentTest extends TestCase
{
    public function testItGetsIdentifier(): void
    {
        $document = new Document(new DocumentIdentifier('id'));

        self::assertEquals('id', $document->getIdentifier()->toString());
    }

    public function testItGetsField(): void
    {
        $emptyDocument = new Document(new DocumentIdentifier('id'));

        self::assertEquals([], $emptyDocument->getFields());

        $document = new Document(new DocumentIdentifier('id'), new DocumentField('key', 'value'));

        self::assertEquals(['key' => 'value'], $document->getFields());
    }
}
