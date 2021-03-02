<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch;

use Aws\CloudSearchDomain\CloudSearchDomainClient;
use Aws\Credentials\Credentials;

final class ClientFactory
{
    public function build(Credentials $credentials, string $region, string $endpoint): CloudSearchDomainClient
    {
        return new CloudSearchDomainClient([
            'credentials' => $credentials,
            'endpoint' => $endpoint,
            'region' => $region,
            'version' => 'latest',
            'validation' => false,
        ]);
    }
}
