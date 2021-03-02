<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch;

use Aws\CloudSearchDomain\CloudSearchDomainClient;
use Aws\Credentials\Credentials;

final class ClientFactory
{
    public function build(Credentials $credentials, string $region): CloudSearchDomainClient
    {
        return new CloudSearchDomainClient([
            'credentials' => $credentials,
            'region' => $region,
            'version' => 'latest',
        ]);
    }
}
