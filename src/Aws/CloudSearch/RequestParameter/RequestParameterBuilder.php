<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter;

use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery\FilterQueryParameter;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Query\QueryParameters;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Sort\SortCollection;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Sort\SortParameter;

class RequestParameterBuilder
{
    private QueryParameters $queryParameters;
    private SortCollection $sortParameters;
    private ?FilterQueryParameter $filterQueryParameters = null;

    public function __construct()
    {
        $this->sortParameters = new SortCollection();
        $this->queryParameters = QueryParameters::matchAny();
    }

    public function withQuery(QueryParameters $queryParameters): self
    {
        $this->queryParameters = $queryParameters;

        return $this;
    }

    public function addSortByField(SortParameter $sortParameter): self
    {
        $this->sortParameters->add($sortParameter);

        return $this;
    }

    public function setFilterQuery(FilterQueryParameter $filterQueryParameter): self
    {
        $this->filterQueryParameters = $filterQueryParameter;

        return $this;
    }

    public function getRequestParameters(): array
    {
        $requestParameters = [
            'query' => $this->queryParameters->getQuery(),
            'queryParser' => $this->queryParameters->getParser(),
        ];

        if (null !== $this->filterQueryParameters) {
            $requestParameters += [
                'filterQuery' => (string) $this->filterQueryParameters,
            ];
        }

        if ($this->sortParameters->hasSortFields()) {
            $requestParameters += [
                'sort' => (string) $this->sortParameters,
            ];
        }

        return $requestParameters;
    }
}