<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record;

interface Measure
{
    public function getName(): string;
    public function getValue(): string;
    public function getValueType(): string;
}
