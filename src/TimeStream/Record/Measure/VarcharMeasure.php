<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record\Measure;

use Landingi\AwsBundle\TimeStream\Exception\InvalidAttributeValueException;
use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Record\Measure;

final class VarcharMeasure implements Measure
{
    private AttributeName $measureName;
    private string $measureValue;

    /**
     * @throws InvalidAttributeValueException
     */
    public function __construct(AttributeName $measureName, string $measureValue)
    {
        if (strlen($measureValue) < 1) {
            throw InvalidAttributeValueException::tooShort();
        }

        $this->measureName = $measureName;
        $this->measureValue = $measureValue;
    }

    public function getName(): string
    {
        return $this->measureName->toString();
    }

    public function getValue(): string
    {
        return $this->measureValue;
    }

    public function getValueType(): string
    {
        return 'VARCHAR';
    }
}
