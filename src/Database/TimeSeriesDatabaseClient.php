<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Record;

interface TimeSeriesDatabaseClient
{
    public function write(AttributeName $tableName, Record ...$records): void;
}
