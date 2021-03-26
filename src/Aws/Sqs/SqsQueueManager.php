<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Sqs;

use Aws\Sqs\SqsClient;
use Landingi\AwsBundle\Queue\QueueManager;
use function is_array;

final class SqsQueueManager implements QueueManager
{
    private SqsClient $client;
    private string $queueEndpoint;
    private string $queueName;

    public function __construct(SqsClient $client, string $queueEndpoint, string $queueName)
    {
        $this->client = $client;
        $this->queueEndpoint = $queueEndpoint;
        $this->queueName = $queueName;
    }

    public function getQueues(): array
    {
        return $this->client->listQueues()->toArray()['QueueUrls'];
    }

    public function getMessages(): array
    {
        $messages = [];
        $response = $this->client->receiveMessage([
            'QueueUrl' => sprintf('%s/%s', $this->queueEndpoint, $this->queueName),
            'MaxNumberOfMessages' => 10,
        ]);

        if (is_array($response->search('Messages'))) {
            foreach ($response->search('Messages') as $message) {
                $messages[] = $message['Body'];
            }
        }

        return $messages;
    }
}
