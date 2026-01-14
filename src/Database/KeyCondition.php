<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database;

interface KeyCondition
{
    public function getKey(): string;
    public function getOperator(): string;

    /**
     * @return mixed
     */
    public function getValue();
}
