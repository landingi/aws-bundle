<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Queue;

interface MessageMetadata
{
    public function getDelay(): int;
}
