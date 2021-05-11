<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream;

use Landingi\AwsBundle\TimeStream\Exception\InvalidAttributeNameException;
use PHPUnit\Framework\TestCase;

class AttributeNameTest extends TestCase
{
    public function testNameTooShort(): void
    {
        self::expectExceptionObject(
            InvalidAttributeNameException::tooShort()
        );
        new AttributeName('');
    }

    public function testToString(): void
    {
        self::assertEquals(
            'foo',
            (new AttributeName('foo'))->toString()
        );
        self::assertEquals(
            'foo',
            (string) new AttributeName('foo')
        );
    }
}
