<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Queue;

use Landingi\AwsBundle\Queue\Message;

final class MemoryMessage implements Message
{
    private array $body;
    private array $attributes;

    public function __construct(array $body, array $attributes = [])
    {
        $this->body = $body;
        $this->attributes = $attributes;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function jsonSerialize(): array
    {
        return $this->body;
    }

    public function duplicate(): self
    {
        return new self($this->body, $this->attributes);
    }
}
