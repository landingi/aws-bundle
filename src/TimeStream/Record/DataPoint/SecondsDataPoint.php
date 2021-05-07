<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record\DataPoint;

use Landingi\AwsBundle\TimeStream\Record\DataPoint;
use Landingi\AwsBundle\TimeStream\Record\Measure;

final class SecondsDataPoint implements DataPoint
{
    private Measure $measure;
    private int $time;

    public function __construct(Measure $measure)
    {
        $this->measure = $measure;
        $this->time = time();
    }

    public function getName(): string
    {
        return $this->measure->getName();
    }

    public function getValue(): string
    {
        return $this->measure->getValue();
    }

    public function getValueType(): string
    {
        return $this->measure->getValueType();
    }

    public function getTime(): string
    {
        return (string) $this->time;
    }

    public function getTimeUnit(): string
    {
        return 'SECONDS';
    }
}
