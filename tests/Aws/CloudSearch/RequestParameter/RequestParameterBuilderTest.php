<?php

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter;

use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery\AndFilterQueryCollection;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery\DoubleFilterQuery;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery\IntegerFilterQuery;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery\NoValueSetFilterQuery;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery\OrFilterQueryCollection;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery\StringFilterQuery;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Query\QueryParameters;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Sort\Direction;
use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Sort\Sort;
use PHPUnit\Framework\TestCase;

class RequestParameterBuilderTest extends TestCase
{
    public function testItBuildsWithDefaultValues(): void
    {
        // Arrange
        $builder = new RequestParameterBuilder();

        // Act
        $requestParameters = $builder->getRequestParameters();

        // Assert
        self::assertSame(
            [
                'query' => 'matchall',
                'queryParser' => 'structured',
            ],
            $requestParameters
        );
    }

    public function testItBuildsWithSearchQueryAndParser(): void
    {
        // Arrange
        $searchQuery = 'Test query';
        $builder = new RequestParameterBuilder();

        // Act
        $requestParameters = $builder
            ->withQuery(QueryParameters::usingLucene($searchQuery))
            ->getRequestParameters();

        // Assert
        self::assertSame(
            [
                'query' => $searchQuery,
                'queryParser' => 'lucene',
            ],
            $requestParameters
        );
    }

    public function testItBuildsWithSingleFilterQuery(): void
    {
        // Arrange
        $builder = new RequestParameterBuilder();
        $filterQuery = StringFilterQuery::create('field', 'value');

        // Act
        $requestParameters = $builder
            ->setFilterQuery($filterQuery)
            ->getRequestParameters();

        // Assert
        self::assertSame(
            [
                'query' => 'matchall',
                'queryParser' => 'structured',
                'filterQuery' => 'field: \'value\'',
            ],
            $requestParameters
        );
    }

    public function testItBuildsWithFilterQueryCollection(): void
    {
        // Arrange
        $builder = new RequestParameterBuilder();
        $filterQueryCollection = (new AndFilterQueryCollection())
            ->add(StringFilterQuery::create('field1', 'value1'))
            ->add(IntegerFilterQuery::create('field2', 1))
            ->add(DoubleFilterQuery::create('field3', 60.02))
            ->add(NoValueSetFilterQuery::forInteger('field4'));


        // Act
        $requestParameters = $builder
            ->setFilterQuery($filterQueryCollection)
            ->getRequestParameters();

        // Assert
        self::assertSame(
            [
                'query' => 'matchall',
                'queryParser' => 'structured',
                'filterQuery' => '(and field1: \'value1\' field2: 1 field3: 60.02 (not (range field=field4 {,9223372036854775807})))',
            ],
            $requestParameters
        );
    }

    public function testItBuildsWithNestedFilterQueryCollection(): void
    {
        // Arrange
        $builder = new RequestParameterBuilder();
        $filterQueryCollection = (new OrFilterQueryCollection())
            ->add(
                (new AndFilterQueryCollection())
                    ->add(StringFilterQuery::create('field1', 'value1'))
                    ->add(StringFilterQuery::create('field2', 'value2'))
            )
            ->add(
                (new OrFilterQueryCollection())
                    ->add(StringFilterQuery::create('field1', 'value3'))
                    ->add(StringFilterQuery::create('field2', 'value4'))
            )
            ->add(new OrFilterQueryCollection())
            ->add(StringFilterQuery::create('field3', 'value1'));


        // Act
        $requestParameters = $builder
            ->setFilterQuery($filterQueryCollection)
            ->getRequestParameters();

        // Assert
        self::assertSame(
            [
                'query' => 'matchall',
                'queryParser' => 'structured',
                'filterQuery' => "(or (and field1: 'value1' field2: 'value2') (or field1: 'value3' field2: 'value4') field3: 'value1')",
            ],
            $requestParameters
        );
    }

    public function testItBuildsWithSortFields(): void
    {
        // Arrange
        $builder = new RequestParameterBuilder();

        // Act
        $requestParameters = $builder
            ->addSortByField(Sort::byScore(Direction::desc()))
            ->addSortByField(Sort::byField('field', Direction::asc()))
            ->getRequestParameters();

        // Assert
        self::assertSame(
            [
                'query' => 'matchall',
                'queryParser' => 'structured',
                'sort' => '_score desc, field asc',
            ],
            $requestParameters
        );
    }
}
