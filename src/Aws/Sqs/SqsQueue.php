<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Sqs;

use Aws\Sqs\SqsClient;
use JsonException;
use Landingi\AwsBundle\Queue\Message;
use Landingi\AwsBundle\Queue\MessageMetadata;
use Landingi\AwsBundle\Queue\QueueClient;
use function array_map;
use function is_array;
use function json_encode;
use function sprintf;

final class SqsQueue implements QueueClient
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

    /**
     * @throws JsonException
     */
    public function sendMessage(Message $message, ?MessageMetadata $metadata = null): void
    {
        $arguments = [
            'QueueUrl' => sprintf('%s/%s', $this->queueEndpoint, $this->queueName),
            'MessageBody' => json_encode($message->getBody(), JSON_THROW_ON_ERROR),
        ];

        if (null !== $metadata) {
            $arguments['DelaySeconds'] = $metadata->getDelay();
        }

        $this->client->sendMessage($arguments);
    }

    public function getMessages(int $numberOfMessages = 10): array
    {
        $response = $this->client->receiveMessage([
            'QueueUrl' => sprintf('%s/%s', $this->queueEndpoint, $this->queueName),
            'MaxNumberOfMessages' => $numberOfMessages,
        ]);

        if (is_array($response->search('Messages'))) {
            return array_map(
                static fn ($message) => $message['Body'],
                $response->search('Messages')
            );
        }

        return [];
    }
}
