<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Sqs;

use Aws\Sqs\SqsClient;
use Landingi\AwsBundle\Queue\QueueManager;
use function is_array;

final class SqsQueueManager implements QueueManager
{
    private SqsClient $client;

    public function __construct(SqsClient $client)
    {
        $this->client = $client;
    }

    public function getQueues(): array
    {
        return $this->client->listQueues()->toArray()['QueueUrls'];
    }
}
