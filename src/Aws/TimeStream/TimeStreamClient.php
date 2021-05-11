<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\TimeStream;

use Aws\TimestreamWrite\TimestreamWriteClient;
use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Record;
use Landingi\AwsBundle\TimeStream\Record\Dimension;
use Landingi\AwsBundle\TimeStream\TimeSeries;

final class TimeStreamClient implements TimeSeries
{
    private TimestreamWriteClient $client;

    public function __construct(TimestreamWriteClient $client)
    {
        $this->client = $client;
    }

    public function write(AttributeName $databaseName, AttributeName $tableName, Record ...$records): void
    {
        $this->client->writeRecords([
            'DatabaseName' => $databaseName->toString(),
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
