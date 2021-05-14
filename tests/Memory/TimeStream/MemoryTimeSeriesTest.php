<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\TimeStream;

use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Record;
use Landingi\AwsBundle\TimeStream\Record\DataPoint\SecondsDataPoint;
use Landingi\AwsBundle\TimeStream\Record\Dimension;
use Landingi\AwsBundle\TimeStream\Record\Measure\BooleanMeasure;
use PHPUnit\Framework\TestCase;

class MemoryTimeSeriesTest extends TestCase
{
    public function testItIsEmpty(): void
    {
        self::assertEmpty(
            (new MemoryTimeSeriesDatabaseClient())->getRecords(
                new AttributeName('database'),
                new AttributeName('table'),
            )
        );
    }

    public function testGetRecords(): void
    {
        // arrange
        $series = new MemoryTimeSeriesDatabaseClient();
        $record = new Record(
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
        );
        $database = new AttributeName('database');
        $table = new AttributeName('table');

        // act
        $series->write(
            $database,
            $table,
            $record
        );

        // assert
        self::assertEquals(
            [$record],
            $series->getRecords(
                $database,
                $table
            )
        );
    }
}
