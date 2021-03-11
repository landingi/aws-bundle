<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory;

use Landingi\AwsBundle\Queue\Message;
use Landingi\AwsBundle\Queue\MessageMetadata;
use Landingi\AwsBundle\Queue\QueueClient;

final class MemoryQueueClient implements QueueClient
{

    public function sendMessage(Message $message, MessageMetadata $metadata) : void
    {
        // TODO: Implement sendMessage() method.
    }
}
