<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries;

use Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidRecordException;
use Landingi\AwsBundle\Database\TimeSeries\Record\DataPoint;
use Landingi\AwsBundle\Database\TimeSeries\Record\Dimension;

final class Record implements DataPoint
{
    private DataPoint $dataPoint;
    private array $dimensions;

    /**
     * @throws \Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidRecordException
     */
    public function __construct(DataPoint $dataPoint, Dimension ...$dimensions)
    {
        $this->dataPoint = $dataPoint;

        if (empty($dimensions)) {
            throw InvalidRecordException::missingDimension();
        }

        $this->dimensions = $dimensions;
    }

    public function getDimensions(): array
    {
        return $this->dimensions;
    }

    public function getTime(): string
    {
        return $this->dataPoint->getTime();
    }

    public function getTimeUnit(): string
    {
        return $this->dataPoint->getTimeUnit();
    }

    public function getName(): string
    {
        return $this->dataPoint->getName();
    }

    public function getValue(): string
    {
        return $this->dataPoint->getValue();
    }

    public function getValueType(): string
    {
        return $this->dataPoint->getValueType();
    }
}
