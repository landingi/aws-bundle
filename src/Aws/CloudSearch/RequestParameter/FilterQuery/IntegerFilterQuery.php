<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery;

final class IntegerFilterQuery implements FilterQueryParameter
{
    private string $field;
    private int $value;

    public function __construct(string $field, int $value)
    {
        $this->field = $field;
        $this->value = $value;
    }

    public static function create(string $field, int $value): self
    {
        return new self($field, $value);
    }

    public function __toString(): string
    {
        return "{$this->field}: {$this->value}";
    }
}