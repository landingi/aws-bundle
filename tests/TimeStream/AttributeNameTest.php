<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream;

use PHPUnit\Framework\TestCase;

class AttributeNameTest extends TestCase
{
    public function testToString(): void
    {
        self::assertEquals(
            'foo',
            (new AttributeName('foo'))->toString()
        );
    }
}
