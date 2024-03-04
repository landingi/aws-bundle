<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Queue;

use Countable;
use Landingi\AwsBundle\Queue\Message;
use Landingi\AwsBundle\Queue\MessageMetadata;
use Landingi\AwsBundle\Queue\QueueClient;
use function array_slice;
use function count;

final class MemoryQueueClient implements QueueClient, Countable
{
    private array $memory = [];

    public function sendMessage(Message $message, MessageMetadata $metadata): void
    {
        $this->memory[] = [
            'message' => $message->jsonSerialize(),
            'meta' => $metadata->getDelay(),
        ];
    }

    public function count(): int
    {
        return count($this->memory);
    }

    public function getMessages(int $numberOfMessages = 10): array
    {
        return array_slice($this->memory, 0, $numberOfMessages);
    }

    public function purge(): void
    {
        $this->memory = [];
    }
}
