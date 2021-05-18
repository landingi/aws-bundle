<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Record;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidAttributeValueException;
use PHPUnit\Framework\TestCase;

class DimensionTest extends TestCase
{
    public function testValueTooShort(): void
    {
        $this->expectExceptionObject(
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
