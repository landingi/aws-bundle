<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\DynamoDb\KeyCriteria;

use Landingi\AwsBundle\Aws\DynamoDb\KeyCondition\Equal;
use Landingi\AwsBundle\Database\ExactKeyCriteria;

final readonly class ExclusiveStartKey implements ExactKeyCriteria
{
    private array $conditions;

    public function __construct(Equal ...$conditions)
    {
        $this->conditions = $conditions;
    }

    public function getConditions(): array
    {
        return $this->conditions;
    }

    public function toKeyValueArray(): array
    {
        $array = [];

        foreach ($this->conditions as $condition) {
            $array[$condition->getKey()] = $condition->getValue();
        }

        return $array;
    }
}
