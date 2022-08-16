<?php

declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Query\Builder;

use PHPUnit\Framework\TestCase;

final class LuceneQueryParametersBuilderTest extends TestCase
{
    public function testItBuildsSimpleQuery(): void
    {
        $builder = LuceneQueryParametersBuilder::forRawQuery('test query');

        self::assertSame('test query', $builder->build()->getQuery());
    }

    public function testItBuildsWithExactMatch(): void
    {
        $builder = LuceneQueryParametersBuilder::forRawQuery('test query  ')
            ->useExactMatchingForIndividualWords();

        self::assertSame('("test" AND "query")', $builder->build()->getQuery());
    }

    public function testItBuildsWithExactMatchAndFields(): void
    {
        $builder = LuceneQueryParametersBuilder::forRawQuery('test query')
            ->useExactMatchingForIndividualWords()
            ->searchByFields('field1', 'field2');

        self::assertSame(
            '((field1: "test" OR field2: "test") AND (field1: "query" OR field2: "query"))',
            $builder->build()->getQuery()
        );
    }

    /**
     * @dataProvider getQueryForWildcardSearch
     */
    public function testItBuildsWithWildcardMatch(string $searchQuery, string $expectedQuery): void
    {
        $builder = LuceneQueryParametersBuilder::forRawQuery($searchQuery)
            ->useWildcardMatching();

        self::assertSame($expectedQuery, $builder->build()->getQuery());
    }

    public function getQueryForWildcardSearch(): \Generator
    {
        yield ['test', '*test*'];
        yield ['test   query', '(*test* AND *query*)'];
        yield [
            'https://landingi.example/test?query-string',
            '*https* AND *landingi.example* AND *test* AND *query* AND *string*',
        ];
        yield [
            '!~@#^$ \\',
            '*@#* AND *$*',
        ];
    }

    /**
     * @dataProvider getQueryForWildcardSearchWithFields
     */
    public function testItBuildsWithWildcardMatchAndFields(string $searchQuery, string $expectedQuery): void
    {
        $builder = LuceneQueryParametersBuilder::forRawQuery($searchQuery)
            ->useWildcardMatching()
            ->searchByFields('field1', 'field2');

        self::assertSame($expectedQuery, $builder->build()->getQuery());
    }

    public function getQueryForWildcardSearchWithFields(): \Generator
    {
        yield ['test', '(field1: *test* OR field2: *test*)'];
        yield ['test query', '((field1: *test* OR field2: *test*) AND (field1: *query* OR field2: *query*))'];
        yield [
            'https://landingi.example/test?query-string',
            '(field1: (*https* AND *landingi.example* AND *test* AND *query* AND *string*) OR field2: (*https* AND *landingi.example* AND *test* AND *query* AND *string*))',
        ];
        yield [
            '!~@#^$ \\',
            '(field1: (*@#* AND *$*) OR field2: (*@#* AND *$*))',
        ];
    }

    /**
     * @dataProvider getQueryForWildcardAndExactSearchWithFields
     */
    public function testItBuildsWithWildcardAndExactMatchAndOneField(string $searchQuery, string $expectedQuery): void
    {
        $builder = LuceneQueryParametersBuilder::forRawQuery($searchQuery)
            ->useWildcardMatching()
            ->useExactMatchingForIndividualWords()
            ->searchByFields('field1');

        self::assertSame($expectedQuery, $builder->build()->getQuery());
    }

    public function getQueryForWildcardAndExactSearchWithFields(): \Generator
    {
        yield ['test', '(field1: "test" OR field1: *test*)'];
        yield ['test query', '((field1: "test" OR field1: *test*) AND (field1: "query" OR field1: *query*))'];
        yield [
            'https://landingi.example/test?query-string',
            '(field1: "https://landingi.example/test?query-string" OR field1: (*https* AND *landingi.example* AND *test* AND *query* AND *string*))',
        ];
        yield [
            '!~@#^$ \\',
            '((field1: "!~@#^$" OR field1: (*@#* AND *$*)) AND field1: "\\\")',
        ];
    }
}
