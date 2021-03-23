<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Queue;

interface Message
{
    public function getBody(): array;
    public function jsonSerialize(): array;
    public function duplicate(): self;
}
