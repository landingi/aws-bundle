<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Queue;

interface MessageAttribute
{
    public function getName(): string;
    public function getDataType(): string;
    public function getStringValue(): string;
}
