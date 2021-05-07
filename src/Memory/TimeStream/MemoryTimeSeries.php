<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\TimeStream;

use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Record;
use Landingi\AwsBundle\TimeStream\TimeSeries;

final class MemoryTimeSeries implements TimeSeries
{
    private array $timeSeries = [];

    public function write(AttributeName $databaseName, AttributeName $tableName, Record ...$records): void
    {
        foreach ($records as $record) {
            $this->timeSeries[$databaseName->toString()][$tableName->toString()][] = $record;
        }
    }

    /**
     * @param AttributeName $databaseName
     * @param AttributeName $tableName
     *
     * @return Record[]
     */
    public function getRecords(AttributeName $databaseName, AttributeName $tableName): array
    {
        return $this->timeSeries[$databaseName->toString()][$tableName->toString()] ?? [];
    }
}
