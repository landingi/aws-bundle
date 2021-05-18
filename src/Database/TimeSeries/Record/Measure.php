<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Record;

interface Measure
{
    public function getName(): string;
    public function getValue(): string;
    public function getValueType(): string;
}
