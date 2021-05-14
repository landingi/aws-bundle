<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Timestream;

use Aws\Credentials\Credentials;
use Aws\TimestreamWrite\TimestreamWriteClient;

final class ClientFactory
{
    public function build(Credentials $credentials, string $region): TimestreamWriteClient
    {
        return new TimestreamWriteClient([
            'credentials' => $credentials,
            'region' => $region,
            'version' => 'latest',
        ]);
    }
}
