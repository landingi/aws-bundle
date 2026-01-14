<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Sort;

final class SortCollection implements SortParameter
{
    private array $sortByFields = [];

    public function add(SortParameter $sortByField): void
    {
        $this->sortByFields[] = $sortByField;
    }

    public function __toString(): string
    {
        return implode(
            ', ',
            array_map(
                static fn(SortParameter $sortByField) => (string) $sortByField,
                $this->sortByFields,
            ),
        );
    }

    public function hasSortFields(): bool
    {
        return count($this->sortByFields) > 0;
    }
}
