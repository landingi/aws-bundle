<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record;

use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Exception\InvalidAttributeValueException;
use PHPUnit\Framework\TestCase;

class DimensionTest extends TestCase
{
    public function testValueTooShort(): void
    {
        self::expectExceptionObject(
            InvalidAttributeValueException::tooShort()
        );
        new Dimension(
            new AttributeName('foo'),
            ''
        );
    }

    public function testGetName(): void
    {
        self::assertEquals(
            'foo',
            (new Dimension(
                new AttributeName('foo'),
                'bar'
            ))->getDimensionName()
        );
    }

    public function testGetValue(): void
    {
        self::assertEquals(
            'bar',
            (new Dimension(
                new AttributeName('foo'),
                'bar'
            ))->getDimensionValue()
        );
    }
}
