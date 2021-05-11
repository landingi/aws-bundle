<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record\Measure;

use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Record\Measure;

final class DoubleMeasure implements Measure
{
    private AttributeName $measureName;
    private float $measureValue;

    public function __construct(AttributeName $measureName, float $measureValue)
    {
        $this->measureName = $measureName;
        $this->measureValue = $measureValue;
    }

    public function getName(): string
    {
        return $this->measureName->toString();
    }

    public function getValue(): string
    {
        return (string) $this->measureValue;
    }

    public function getValueType(): string
    {
        return 'DOUBLE';
    }
}
