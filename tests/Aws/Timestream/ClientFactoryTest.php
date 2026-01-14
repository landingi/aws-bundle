<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Timestream;

use Aws\Credentials\Credentials;
use Aws\TimestreamWrite\TimestreamWriteClient;
use PHPUnit\Framework\TestCase;

class ClientFactoryTest extends TestCase
{
    public function testBuild(): void
    {
        // arrange
        $factory = new ClientFactory();
        $credentials = new Credentials('key', 'secret');
        $region = 'region';

        // act & assert
        self::assertEquals(
            new TimestreamWriteClient([
                'credentials' => $credentials,
                'region' => $region,
                'version' => 'latest',
            ]),
            $factory->build(
                $credentials,
                $region,
            ),
        );
    }
}
