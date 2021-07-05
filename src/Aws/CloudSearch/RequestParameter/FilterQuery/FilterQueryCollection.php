<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery;

abstract class FilterQueryCollection implements FilterQueryParameter
{
    private array $filterQueries = [];

    abstract protected function getOperator(): string;

    public function add(FilterQueryParameter $filterQuery): self
    {
        $this->filterQueries[] = $filterQuery;

        return $this;
    }

    public function __toString(): string
    {
        $filterQueriesString = implode(
            ' ',
            array_filter(
                array_map(
                    static fn (FilterQueryParameter $filterQuery) => (string) $filterQuery,
                    $this->filterQueries,
                ),
                static fn (string $filterQueryString) => '' !== $filterQueryString
            )
        );

        if ('' === $filterQueriesString) {
            return '';
        }

        return sprintf('(%s %s)', $this->getOperator(), $filterQueriesString);
    }
}
