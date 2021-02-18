<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Sqs;

use Aws\Sqs\SqsClient;
use JsonException;
use Landingi\AwsBundle\Queue\Message;
use Landingi\AwsBundle\Queue\MessageMetadata;
use Landingi\AwsBundle\Queue\QueueClient;

final class SqsQueue implements QueueClient
{
    private SqsClient $client;
    private string $queue;

    public function __construct(SqsClient $client, string $queue)
    {
        $this->client = $client;
        $this->queue = $queue;
    }

    /**
     * @throws JsonException
     */
    public function sendMessage(Message $message, ?MessageMetadata $metadata = null): void
    {
        $arguments = [
            'QueueUrl' => $this->getQueueUrl(),
            'MessageBody' => json_encode($message->getBody(), JSON_THROW_ON_ERROR),
        ];

        if (null !== $metadata) {
            $arguments['DelaySeconds'] = $metadata->getDelay();
        }

        $this->client->sendMessage($arguments);
    }

    private function getQueueUrl(): string
    {
        $endpoint = (string) $this->client->getEndpoint();

        if (!$endpoint) {
            $endpoint = sprintf('https://sqs.%s.amazonaws.com/08482476796', $this->client->getRegion());
        }

        return "${endpoint}/{$this->queue}";
    }
}
