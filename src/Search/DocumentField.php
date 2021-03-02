<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Search;

final class DocumentField
{
    private string $key;
    private string $value;

    public function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function toArray(): array
    {
        return [$this->key => $this->value];
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
