<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory;

use Landingi\AwsBundle\Queue\MessageMetadata;

final class MemoryMessageMetadata implements MessageMetadata
{
    private int $delay;

    public function __construct(int $delay)
    {
        $this->delay = $delay;
    }

    public function getDelay(): int
    {
        return $this->delay;
    }
}
