<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Database;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Record;
use Landingi\AwsBundle\Database\TimeSeries\Record\DataPoint\SecondsDataPoint;
use Landingi\AwsBundle\Database\TimeSeries\Record\Dimension;
use Landingi\AwsBundle\Database\TimeSeries\Record\Measure\BooleanMeasure;
use PHPUnit\Framework\TestCase;

class MemoryTimeSeriesTest extends TestCase
{
    public function testItIsEmpty(): void
    {
        self::assertEmpty(
            (new MemoryTimeSeriesDatabaseClient('database'))->getRecords(new AttributeName('table'))
        );
    }

    public function testGetRecords(): void
    {
        // arrange
        $series = new MemoryTimeSeriesDatabaseClient('database');
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
        $series->write($table, $record);

        // assert
        self::assertEquals([$record], $series->getRecords($table));
    }
}
