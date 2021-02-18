<?php
declare(strict_types=1);

namespace Landingi\Core\Aws\Sns;

use Aws\Sns\SnsClient;
use JsonException;
use Landingi\Core\Notification\Message;
use Landingi\Core\Notification\NotificationClient;

final class SnsNotification implements NotificationClient
{
    private SnsClient $client;
    private string $topic;

    public function __construct(SnsClient $client, string $topic)
    {
        $this->client = $client;
        $this->topic = $topic;
    }

    /**
     * @throws JsonException
     */
    public function publish(Message $message): void
    {
        $this->client->publish([
            'TopicArn' => $this->topic,
            'Message' => json_encode($message->getData(), JSON_THROW_ON_ERROR),
        ]);
    }
}
