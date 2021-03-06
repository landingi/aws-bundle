<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Queue;

use Landingi\AwsBundle\Queue\Message;

final class MemoryMessage implements Message
{
    private array $body;

    public function __construct(array $body)
    {
        $this->body = $body;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function jsonSerialize(): array
    {
        return $this->body;
    }

    public function duplicate(): self
    {
        return new self($this->body);
    }
}
