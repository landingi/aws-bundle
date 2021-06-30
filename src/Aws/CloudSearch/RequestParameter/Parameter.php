<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter;

interface Parameter
{
    public function __toString(): string;
}