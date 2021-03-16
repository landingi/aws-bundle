<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Search;

use PHPUnit\Framework\TestCase;

final class DocumentIdentifierTest extends TestCase
{
    public function testItConvertsToString(): void
    {
        self::assertEquals('id', (new DocumentIdentifier('id'))->toString());
        self::assertEquals('id', (string) new DocumentIdentifier('id'));
    }
}
