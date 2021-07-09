<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery;

use RuntimeException;

final class NoValueSetFilterQuery implements FilterQueryParameter
{
    private string $field;
    private string $type;

    public function __construct(string $field, string $type)
    {
        $this->field = $field;
        $this->type = $type;
    }

    public static function forInteger(string $field): self
    {
        return new self($field, 'integer');
    }

    public static function forDate(string $field): self
    {
        return new self($field, 'date');
    }

    public static function forString(string $field): self
    {
        return new self($field, 'string');
    }

    public function __toString(): string
    {
        if ('integer' === $this->type) {
            return sprintf("(not (range field=%s {,9223372036854775807}))", $this->field);
        }

        if ('date' === $this->type) {
            return sprintf("(not (range field=%s {'0000-01-01T00:00:00.000Z',}))", $this->field);
        }

        if ('string' === $this->type) {
            return sprintf("(not (prefix field=%s ''))", $this->field);
        }

        throw new RuntimeException(sprintf('Unknown filter query field type: %s', $this->type));
    }
}
