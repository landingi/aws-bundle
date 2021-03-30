<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Queue;

interface QueueManager
{
    public function getMessages(): array;
    public function getQueues(): array;
}
