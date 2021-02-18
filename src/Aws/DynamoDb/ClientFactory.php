<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\DynamoDb;

use Aws\Credentials\Credentials;
use Aws\DynamoDb\DynamoDbClient;

final class ClientFactory
{
    public function build(Credentials $credentials, string $region): DynamoDbClient
    {
        return new DynamoDbClient([
            'credentials' => $credentials,
            'region' => $region,
            'version' => 'latest',
        ]);
    }
}
