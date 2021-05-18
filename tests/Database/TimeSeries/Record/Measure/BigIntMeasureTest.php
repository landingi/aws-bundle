<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Record\Measure;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use PHPUnit\Framework\TestCase;

class BigIntMeasureTest extends TestCase
{
    public function testGetValue(): void
    {
        self::assertEquals(
            '10',
            (new BigIntMeasure(
                new AttributeName('foo'),
                10
            ))->getValue()
        );
    }

    public function testGetValueType(): void
    {
        self::assertEquals(
            'BIGINT',
            (new BigIntMeasure(
                new AttributeName('foo'),
                10
            ))->getValueType()
        );
    }

    public function testGetName(): void
    {
        self::assertEquals(
            'foo',
            (new BigIntMeasure(
                new AttributeName('foo'),
                10
            ))->getName()
        );
    }
}
