<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream;

use Landingi\AwsBundle\TimeStream\Exception\InvalidRecordException;
use Landingi\AwsBundle\TimeStream\Record\DataPoint\SecondsDataPoint;
use Landingi\AwsBundle\TimeStream\Record\Dimension;
use Landingi\AwsBundle\TimeStream\Record\Measure\BooleanMeasure;
use PHPUnit\Framework\TestCase;

class RecordTest extends TestCase
{
    public function testMissingDimensions(): void
    {
        self::expectExceptionObject(
            InvalidRecordException::missingDimension()
        );
        new Record(
            new SecondsDataPoint(
                new BooleanMeasure(
                    new AttributeName('foo'),
                    true
                )
            )
        );
    }

    public function testGetDimensions(): void
    {
        self::assertEquals(
            [
                new Dimension(
                    new AttributeName('bar'),
                    'baz'
                ),
            ],
            (new Record(
                new SecondsDataPoint(
                    new BooleanMeasure(
                        new AttributeName('foo'),
                        true
                    )
                ),
                new Dimension(
                    new AttributeName('bar'),
                    'baz'
                )
            ))->getDimensions()
        );
    }

    public function testGetName(): void
    {
        // arrange
        $dataPoint = new SecondsDataPoint(
            new BooleanMeasure(
                new AttributeName('foo'),
                true
            )
        );
        $record = new Record(
            $dataPoint,
            new Dimension(
                new AttributeName('bar'),
                'baz'
            )
        );

        // act & assert
        self::assertEquals(
            $dataPoint->getName(),
            $record->getName()
        );
    }

    public function testGetValue(): void
    {
        // arrange
        $dataPoint = new SecondsDataPoint(
            new BooleanMeasure(
                new AttributeName('foo'),
                true
            )
        );
        $record = new Record(
            $dataPoint,
            new Dimension(
                new AttributeName('bar'),
                'baz'
            )
        );

        // act & assert
        self::assertEquals(
            $dataPoint->getValue(),
            $record->getValue()
        );
    }

    public function testGetValueType(): void
    {
        // arrange
        $dataPoint = new SecondsDataPoint(
            new BooleanMeasure(
                new AttributeName('foo'),
                true
            )
        );
        $record = new Record(
            $dataPoint,
            new Dimension(
                new AttributeName('bar'),
                'baz'
            )
        );

        // act & assert
        self::assertEquals(
            $dataPoint->getValueType(),
            $record->getValueType()
        );
    }

    public function testGetTime(): void
    {
        // arrange
        $dataPoint = new SecondsDataPoint(
            new BooleanMeasure(
                new AttributeName('foo'),
                true
            )
        );
        $record = new Record(
            $dataPoint,
            new Dimension(
                new AttributeName('bar'),
                'baz'
            )
        );

        // act & assert
        self::assertEquals(
            $dataPoint->getTime(),
            $record->getTime()
        );
    }

    public function testGetTimeUnit(): void
    {
        // arrange
        $dataPoint = new SecondsDataPoint(
            new BooleanMeasure(
                new AttributeName('foo'),
                true
            )
        );
        $record = new Record(
            $dataPoint,
            new Dimension(
                new AttributeName('bar'),
                'baz'
            )
        );

        // act & assert
        self::assertEquals(
            $dataPoint->getTimeUnit(),
            $record->getTimeUnit()
        );
    }
}
