<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\Sqs;

use Landingi\AwsBundle\Queue\Message;
use Landingi\AwsBundle\Queue\MessageAttribute;

final class SqsMessage implements Message
{
    private array $body;

    /**
     * @var array<MessageAttribute>
     */
    private array $attributes;

    /**
     * @param array $body
     * @param array<MessageAttribute> $attributes
     */
    public function __construct(array $body, array $attributes = [])
    {
        $this->body = $body;
        $this->attributes = $attributes;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return array<MessageAttribute>
     */
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
