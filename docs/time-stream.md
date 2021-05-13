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

services:
    aws.credentials:
        class: 'Aws\Credentials\Credentials'
        arguments: ['%env(AWS_ACCESS_KEY_ID)%', '%env(AWS_SECRET_ACCESS_KEY)%']

    Landingi\AwsBundle\Aws\TimeStream\ClientFactory: ~

    Landingi\AwsBundle\TimeStream\TimeSeries:
        class: Landingi\AwsBundle\Aws\TimeStream\TimeStreamClient
        factory: ['@Landingi\AwsBundle\Aws\TimeStream\ClientFactory', 'build']
        arguments:
            - '@aws.credentials'
            - '%aws.region.west%'
```

## Usage example

```php
$stream = new MemoryTimeSeries(); // use TimeStreamClient from DI in prod
$stream->write(
    new AttributeName('database_name'),
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
