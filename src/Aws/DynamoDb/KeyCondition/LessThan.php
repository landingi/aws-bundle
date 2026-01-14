<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\DynamoDb\KeyCondition;

use Landingi\AwsBundle\Database\KeyCondition;

final readonly class LessThan implements KeyCondition
{
    public function __construct(
        private string $key,
        private mixed $value,
    ) {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getOperator(): string
    {
        return '<';
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
