<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Record\Measure;

use Landingi\AwsBundle\Database\TimeSeries\AttributeName;
use Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidAttributeValueException;
use Landingi\AwsBundle\Database\TimeSeries\Record\Measure;

use function trim;

final class VarcharMeasure implements Measure
{
    private AttributeName $measureName;
    private string $measureValue;

    /**
     * @throws \Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidAttributeValueException
     */
    public function __construct(AttributeName $measureName, string $measureValue)
    {
        if ('' === trim($measureValue)) {
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
