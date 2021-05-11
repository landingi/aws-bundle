<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record\DataPoint;

use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Record\Measure\BooleanMeasure;
use PHPUnit\Framework\TestCase;

class SecondsDataPointTest extends TestCase
{
    public function testGetTimeUnit(): void
    {
        self::assertEquals(
            'SECONDS',
            (new SecondsDataPoint(
                new BooleanMeasure(
                    new AttributeName('foo'),
                    true
                )
            ))->getTimeUnit()
        );
    }

    public function testGetTime(): void
    {
        self::assertEquals(
            (string) time(),
            (new SecondsDataPoint(
                new BooleanMeasure(
                    new AttributeName('foo'),
                    true
                )
            ))->getTime()
        );
    }

    public function testGetName(): void
    {
        // arrange
        $measure = new BooleanMeasure(
            new AttributeName('foo'),
            true
        );
        $dataPoint = new SecondsDataPoint($measure);

        // act & assert
        self::assertEquals(
            $measure->getName(),
            $dataPoint->getName()
        );
    }

    public function testGetValue(): void
    {
        // arrange
        $measure = new BooleanMeasure(
            new AttributeName('foo'),
            true
        );
        $dataPoint = new SecondsDataPoint($measure);

        // act & assert
        self::assertEquals(
            $measure->getValue(),
            $dataPoint->getValue()
        );
    }

    public function testGetValueType(): void
    {
        // arrange
        $measure = new BooleanMeasure(
            new AttributeName('foo'),
            true
        );
        $dataPoint = new SecondsDataPoint($measure);

        // act & assert
        self::assertEquals(
            $measure->getValueType(),
            $dataPoint->getValueType()
        );
    }
}
