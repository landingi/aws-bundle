<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record\Measure;

use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Exception\InvalidAttributeValueException;
use PHPUnit\Framework\TestCase;

class VarcharMeasureTest extends TestCase
{
    public function testTooShortValue(): void
    {
        self::expectExceptionObject(
            InvalidAttributeValueException::tooShort()
        );
        new VarcharMeasure(
            new AttributeName('foo'),
            ''
        );
    }

    public function testGetValue(): void
    {
        self::assertEquals(
            'bar',
            (new VarcharMeasure(
                new AttributeName('foo'),
                'bar'
            ))->getValue()
        );
    }

    public function testGetValueType(): void
    {
        self::assertEquals(
            'VARCHAR',
            (new VarcharMeasure(
                new AttributeName('foo'),
                'bar'
            ))->getValueType()
        );
    }

    public function testGetName(): void
    {
        self::assertEquals(
            'foo',
            (new VarcharMeasure(
                new AttributeName('foo'),
                'bar'
            ))->getName()
        );
    }
}
