<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Sqs;

use Landingi\AwsBundle\Queue\MessageMetadata;
use Landingi\AwsBundle\Queue\QueueException;

final class Delay implements MessageMetadata
{
    private int $delay;

    /**
     * @throws \Landingi\AwsBundle\Queue\QueueException
     */
    public static function createDefault(): self
    {
        return new self(0);
    }

    /**
     * @throws \Landingi\AwsBundle\Queue\QueueException
     */
    public function __construct(int $delay)
    {
        if (0 > $delay) {
            throw new QueueException('Cannot delay a message into the past!');
        }

        if (900 < $delay) {
            throw new QueueException('Cannot delay SQS messages more than 15 minutes!');
        }

        $this->delay = $delay;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }
}
