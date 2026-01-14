<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\DynamoDb\KeyCriteria;

use Landingi\AwsBundle\Database\KeyCondition;
use Landingi\AwsBundle\Database\KeyCriteria;

final class LooseKeyCriteria implements KeyCriteria
{
    private array $conditions;

    public function __construct(KeyCondition ...$conditions)
    {
        $this->conditions = $conditions;
    }

    public function getConditions(): array
    {
        return $this->conditions;
    }
}
