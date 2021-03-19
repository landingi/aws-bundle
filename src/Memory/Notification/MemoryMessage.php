<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Notification;

use Landingi\AwsBundle\Notification\Message;

final class MemoryMessage implements Message
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->getData();
    }
}
