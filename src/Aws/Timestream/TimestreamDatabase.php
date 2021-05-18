<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Timestream;

use Aws\TimestreamWrite\TimestreamWriteClient;
use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Record;
use Landingi\AwsBundle\Database\TimeSeries\Record\Dimension;
use Landingi\AwsBundle\Database\TimeSeriesDatabaseClient;

final class TimestreamDatabase implements TimeSeriesDatabaseClient
{
    private TimestreamWriteClient $client;
    private string $databaseName;

    public function __construct(TimestreamWriteClient $client, string $databaseName)
    {
        $this->client = $client;
        $this->databaseName = $databaseName;
    }

    public function write(AttributeName $tableName, Record ...$records): void
    {
        $this->client->writeRecords([
            'DatabaseName' => $this->databaseName,
            'TableName' => $tableName->toString(),
            'Records' => array_map(
                fn (Record $record) => [
                    'Dimensions' => array_map(
                        fn (Dimension $dimension) => [
                            'DimensionValueType' => 'VARCHAR',
                            'Name' => $dimension->getDimensionName(),
                            'Value' => $dimension->getDimensionValue(),
                        ],
                        $record->getDimensions()
                    ),
                    'MeasureName' => $record->getName(),
                    'MeasureValue' => $record->getValue(),
                    'MeasureValueType' => $record->getValueType(),
                    'Time' => $record->getTime(),
                    'TimeUnit' => $record->getTimeUnit(),
                ],
                $records
            ),
        ]);
    }
}
