<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Search;

use PHPUnit\Framework\TestCase;

final class DocumentFieldTest extends TestCase
{
    public function testItGetsKey(): void
    {
        self::assertEquals('key', (new DocumentField('key', 'value'))->getKey());
    }

    public function testItGetsValue(): void
    {
        self::assertEquals('value', (new DocumentField('key', 'value'))->getValue());
    }

    public function testItConvertsToArray(): void
    {
        self::assertEquals(['key' => 'value'], (new DocumentField('key', 'value'))->toArray());
    }
}
