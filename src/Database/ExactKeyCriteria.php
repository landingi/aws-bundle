<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database;

interface ExactKeyCriteria extends KeyCriteria
{
    public function toKeyValueArray(): array;
}
