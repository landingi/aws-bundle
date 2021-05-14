<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Database;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Record;
use Landingi\AwsBundle\Database\TimeSeriesDatabaseClient;

final class MemoryTimeSeriesDatabaseClient implements TimeSeriesDatabaseClient
{
    private array $timeSeries = [];
    private string $databaseName;

    public function __construct(string $databaseName)
    {
        $this->databaseName = $databaseName;
    }

    public function write(AttributeName $tableName, Record ...$records): void
    {
        foreach ($records as $record) {
            $this->timeSeries[$this->databaseName][$tableName->toString()][] = $record;
        }
    }

    /**
     * @return Record[]
     */
    public function getRecords(AttributeName $tableName): array
    {
        return $this->timeSeries[$this->databaseName][$tableName->toString()] ?? [];
    }
}
