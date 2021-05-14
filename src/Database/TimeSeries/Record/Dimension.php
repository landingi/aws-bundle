<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Record;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidAttributeValueException;

final class Dimension
{
    private AttributeName $dimensionName;
    private string $dimensionValue;

    /**
     * @throws \Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidAttributeValueException
     */
    public function __construct(AttributeName $dimensionName, string $dimensionValue)
    {
        if ('' === $dimensionValue) {
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
