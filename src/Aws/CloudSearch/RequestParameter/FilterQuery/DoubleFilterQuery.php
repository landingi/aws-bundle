<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery;

final class DoubleFilterQuery implements FilterQueryParameter
{
    private string $field;
    private float $value;

    public function __construct(string $field, float $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public static function create(string $field, float $value): self
    {
        return new self($field, $value);
    }

    public function __toString(): string
    {
        return "{$this->field}: {$this->value}";
    }
}
