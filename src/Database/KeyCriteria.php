<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database;

interface KeyCriteria
{
    /** @return KeyCondition[] */
    public function getConditions(): array;
}
