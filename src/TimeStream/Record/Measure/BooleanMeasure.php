<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record\Measure;

use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Record\Measure;

final class BooleanMeasure implements Measure
{
    private AttributeName $measureName;
    private bool $measureValue;

    public function __construct(AttributeName $measureName, bool $measureValue)
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
        return $this->measureValue ? 'true': 'false';
    }

    public function getValueType(): string
    {
        return 'DOUBLE';
    }
}
