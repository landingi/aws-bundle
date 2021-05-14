<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries;

use Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidAttributeNameException;
use function trim;

final class AttributeName
{
    private string $attributeName;

    /**
     * @throws \Landingi\AwsBundle\Database\TimeSeries\Exception\InvalidAttributeNameException
     */
    public function __construct(string $attributeName)
    {
        if (trim($attributeName) === '') {
            throw InvalidAttributeNameException::tooShort();
        }

        $this->attributeName = $attributeName;
    }

    public function toString(): string
    {
        return $this->attributeName;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
