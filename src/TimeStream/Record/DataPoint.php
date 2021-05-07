<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record;

interface DataPoint extends Measure
{
    public function getTime(): string;
    public function getTimeUnit(): string;
}
