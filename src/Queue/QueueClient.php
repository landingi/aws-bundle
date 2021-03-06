<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Queue;

interface QueueClient
{
    public function sendMessage(Message $message, MessageMetadata $metadata): void;
    public function getMessages(int $numberOfMessages = 10): array;
}
