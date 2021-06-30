<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Exception;

use RuntimeException;

final class InvalidQueryParametersException extends RuntimeException
{
    public static function missing(): self
    {
        return new self('Missing query parameters');
    }
}