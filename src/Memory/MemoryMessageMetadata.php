<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory;

use Landingi\AwsBundle\Queue\MessageMetadata;
use Landingi\AwsBundle\Queue\QueueException;

final class MemoryMessageMetadata implements MessageMetadata
{
    private int $delay;

    /**
     * @throws QueueException
     */
    public function __construct(int $delay)
    {
        if ($delay < 0) {
            throw new QueueException('Invalid Metadata value');
        }

        $this->delay = $delay;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }
}
