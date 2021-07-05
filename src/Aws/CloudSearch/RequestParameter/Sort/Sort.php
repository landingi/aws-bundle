<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Sort;

final class Sort implements SortParameter
{
    private string $field;
    private Direction $direction;

    private function __construct(string $field, Direction $direction)
    {
        $this->field = $field;
        $this->direction = $direction;
    }

    public static function byField(string $field, Direction $direction): self
    {
        return new self($field, $direction);
    }

    public static function byScore(Direction $direction): self
    {
        return new self('_score', $direction);
    }

    public function __toString(): string
    {
        return "{$this->field} {$this->direction}";
    }
}
