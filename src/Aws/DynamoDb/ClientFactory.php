<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\DynamoDb;

use Aws\Credentials\Credentials;
use Aws\DynamoDb\DynamoDbClient;

final class ClientFactory
{
    public function build(Credentials $credentials, string $region, string $endpoint): DynamoDbClient
    {
        $config = [
            'credentials' => $credentials,
            'region' => $region,
            'version' => 'latest',
        ];

        if ($endpoint) {
            $config['endpoint'] = $endpoint;
        }

        return new DynamoDbClient($config);
    }
}
