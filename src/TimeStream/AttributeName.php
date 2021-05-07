<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream;

use Landingi\AwsBundle\TimeStream\Exception\InvalidAttributeNameException;

final class AttributeName
{
    private string $attributeName;

    /**
     * @throws InvalidAttributeNameException
     */
    public function __construct(string $attributeName)
    {
        if (strlen($attributeName) < 1) {
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
