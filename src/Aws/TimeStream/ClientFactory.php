<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\TimeStream;

use Aws\Credentials\Credentials;
use Aws\TimestreamWrite\TimestreamWriteClient;
use Landingi\AwsBundle\TimeStream\TimeSeries;

final class ClientFactory
{
    public function build(Credentials $credentials, string $region): TimeSeries
    {
        return new TimeStreamClient(
            new TimestreamWriteClient([
                'credentials' => $credentials,
                'region' => $region,
                'version' => 'latest',
            ])
        );
    }
}
