<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Record;

use Landingi\AwsBundle\TimeStream\AttributeName;
use Landingi\AwsBundle\TimeStream\Exception\InvalidAttributeValueException;

final class Dimension
{
    private AttributeName $dimensionName;
    private string $dimensionValue;

    /**
     * @throws InvalidAttributeValueException
     */
    public function __construct(AttributeName $dimensionName, string $dimensionValue)
    {
        if (strlen($dimensionValue) < 1) {
            throw InvalidAttributeValueException::tooShort();
        }

        $this->dimensionName = $dimensionName;
        $this->dimensionValue = $dimensionValue;
    }

    public function getDimensionName(): string
    {
        return $this->dimensionName->toString();
    }

    public function getDimensionValue(): string
    {
        return $this->dimensionValue;
    }
}
