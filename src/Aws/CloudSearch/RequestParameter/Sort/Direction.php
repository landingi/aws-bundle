<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Sort;

final class Direction
{
    private const ASC = 'asc';
    private const DESC = 'desc';

    private string $direction;

    private function __construct(string $direction)
    {
        $this->direction = $direction;
    }

    public static function asc(): self
    {
        return new self(self::ASC);
    }

    public static function desc(): self
    {
        return new self(self::DESC);
    }

    public function __toString(): string
    {
        return $this->direction;
    }
}