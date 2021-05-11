<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record\Measure;

use Landingi\AwsBundle\TimeStream\AttributeName;
use PHPUnit\Framework\TestCase;

class BooleanMeasureTest extends TestCase
{
    public function testGetValue(): void
    {
        self::assertEquals(
            'true',
            (new BooleanMeasure(
                new AttributeName('foo'),
                true
            ))->getValue()
        );
        self::assertEquals(
            'false',
            (new BooleanMeasure(
                new AttributeName('foo'),
                false
            ))->getValue()
        );
    }

    public function testGetValueType(): void
    {
        self::assertEquals(
            'BOOLEAN',
            (new BooleanMeasure(
                new AttributeName('foo'),
                true
            ))->getValueType()
        );
    }

    public function testGetName(): void
    {
        self::assertEquals(
            'foo',
            (new BooleanMeasure(
                new AttributeName('foo'),
                true
            ))->getName()
        );
    }
}
