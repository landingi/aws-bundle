# AWS S3

## ENV

Required `ENV` variables

```dotenv
AWS_ACCESS_KEY_ID
AWS_SECRET_ACCESS_KEY
```

## Default configuration

```yaml
parameters:
    aws.region.west: 'eu-west-1'
    aws.timestream.database-name: 'database-name'

services:
    aws.credentials:
        class: 'Aws\Credentials\Credentials'
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']

    Landingi\AwsBundle\Aws\Timestream\ClientFactory: ~

    aws.timestream.client.west:
        class: Aws\TimestreamWrite\TimestreamWriteClient
        factory: ['@Landingi\AwsBundle\Aws\Timestream\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'

    aws.timestream.database-name:
        class: Landingi\AwsBundle\Aws\Timestream\TimestreamDatabase
        arguments:
            - '@aws.timestream.client.west'
            - '%aws.timestream.database-name%'
```

## Usage example

```php
$stream = new MemoryTimeSeries('database_name'); // use TimeStreamClient from DI in prod
$stream->write(
    new AttributeName('table_name'),
    new Record(
        new SecondsDataPoint(
            new BigIntMeasure(
                new AttributeName('measure_name'),
                $measureValue = 100
            )
        ),
        new Dimension(
            new AttributeName('dimension_name'),
            'dimension_value'
        )
    )
);
```

## Symfony example

```yaml
services:
    Foo\Bar:
        class: Foo\Bar
        arguments:
            - '@aws.timestream.database-name'
```

```php
<?php
declare(strict_types=1);

namespace Foo\Bar;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Record;
use Landingi\AwsBundle\Database\TimeSeries\Record\DataPoint\SecondsDataPoint;
use Landingi\AwsBundle\Database\TimeSeries\Record\Dimension;
use Landingi\AwsBundle\Database\TimeSeries\Record\Measure\BigIntMeasure;
use Landingi\AwsBundle\Database\TimeSeriesDatabaseClient;

class FooBar
{
    private TimeSeriesDatabaseClient $database;

    public function __construct(TimeSeriesDatabaseClient $database)
    {
        $this->database = $database;
    }
    
    public function doFoo(): void
    {
        $this->database->write(
            new AttributeName('table_name'),
            new Record(
                new SecondsDataPoint(
                    new BigIntMeasure(
                        new AttributeName('measure_name'),
                        $measureValue = 100
                    )
                ),
                new Dimension(
                    new AttributeName('dimension_name'),
                    'dimension_value'
                )
            )
        );
    }
}
```
