<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery;

final class StringFilterQuery implements FilterQueryParameter
{
    private string $field;
    private string $value;

    public function __construct(string $field, string $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public static function create(string $field, string $value): self
    {
        return new self($field, $value);
    }

    public function __toString(): string
    {
        return "{$this->field}: '{$this->value}'";
    }
}
