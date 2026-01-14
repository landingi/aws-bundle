<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\DynamoDb\KeyCondition;

use Landingi\AwsBundle\Database\KeyCondition;

final class LessThan implements KeyCondition
{
    private string $key;
    private $value;

    public function __construct(string $key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getOperator(): string
    {
        return '<';
    }

    public function getValue()
    {
        return $this->value;
    }
}
