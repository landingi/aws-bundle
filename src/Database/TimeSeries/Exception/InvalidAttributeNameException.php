<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Exception;

use Exception;

final class InvalidAttributeNameException extends Exception
{
    public static function tooShort(): self
    {
        return new self('Attribute name must be at least one character long');
    }
}
