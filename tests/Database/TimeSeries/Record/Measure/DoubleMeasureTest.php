<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Record\Measure;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use PHPUnit\Framework\TestCase;

class DoubleMeasureTest extends TestCase
{
    public function testGetValue(): void
    {
        self::assertEquals(
            '1.5',
            (new DoubleMeasure(
                new AttributeName('foo'),
                1.5
            ))->getValue()
        );
    }

    public function testGetValueType(): void
    {
        self::assertEquals(
            'DOUBLE',
            (new DoubleMeasure(
                new AttributeName('foo'),
                1.5
            ))->getValueType()
        );
    }

    public function testGetName(): void
    {
        self::assertEquals(
            'foo',
            (new DoubleMeasure(
                new AttributeName('foo'),
                1.5
            ))->getName()
        );
    }
}
