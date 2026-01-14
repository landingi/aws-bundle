<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Record\Measure;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidAttributeValueException;
use PHPUnit\Framework\TestCase;

class VarcharMeasureTest extends TestCase
{
    public function testTooShortValue(): void
    {
        $this->expectExceptionObject(
            InvalidAttributeValueException::tooShort(),
        );
        new VarcharMeasure(
            new AttributeName('foo'),
            '',
        );
    }

    public function testGetValue(): void
    {
        self::assertEquals(
            'bar',
            (new VarcharMeasure(
                new AttributeName('foo'),
                'bar',
            ))->getValue(),
        );
    }

    public function testGetValueType(): void
    {
        self::assertEquals(
            'VARCHAR',
            (new VarcharMeasure(
                new AttributeName('foo'),
                'bar',
            ))->getValueType(),
        );
    }

    public function testGetName(): void
    {
        self::assertEquals(
            'foo',
            (new VarcharMeasure(
                new AttributeName('foo'),
                'bar',
            ))->getName(),
        );
    }
}
