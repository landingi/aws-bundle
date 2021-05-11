<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream;

interface TimeSeries
{
    public function write(AttributeName $databaseName, AttributeName $tableName, Record ...$records): void;
}
