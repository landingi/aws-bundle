<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database\TimeSeries\Exception;

use Exception;

final class InvalidRecordException extends Exception
{
    public static function missingDimension(): self
    {
        return new self('Each record must have at least one dimension');
    }
}
