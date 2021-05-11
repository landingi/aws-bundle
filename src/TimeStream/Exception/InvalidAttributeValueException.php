<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\TimeStream\Exception;

use Exception;

final class InvalidAttributeValueException extends Exception
{
    public static function tooShort(): self
    {
        return new self('Measure value must be at least one character length');
    }
}
