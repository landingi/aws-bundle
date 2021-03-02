<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch;

use Aws\CloudSearch\CloudSearchClient;
use Aws\Credentials\Credentials;

final class ClientFactory
{
    public function build(Credentials $credentials, string $region): CloudSearchClient
    {
        return new CloudSearchClient([
            'credentials' => $credentials,
            'region' => $region,
            'version' => 'latest',
        ]);
    }
}
