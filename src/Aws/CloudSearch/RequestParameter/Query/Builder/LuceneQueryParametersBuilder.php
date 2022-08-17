<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Query\Builder;

use Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Query\QueryParameters;

final class LuceneQueryParametersBuilder
{
    private const SEARCH_FIELD_PATTERN = '%s:';
    private const EXACT_MATCH_PATTERN = '"%s"';
    private const WILDCARD_MATCH_PATTERN = '*%s*';
    private const OPERATOR_OR = 'OR';
    private const OPERATOR_AND = 'AND';
    private const SPECIAL_CHARACTERS = [
        '+', '-', '&&', '||', '!', '(', ')', '{', '}', '[', ']', '^', '"', '~', '*', '?', ':', '/', '\\'
    ];

    private string $rawQuery;
    private bool $shouldUseExactMatchingForIndividualWords = false;
    private bool $shouldUseWildcardMatching = false;
    /** @var array<string> */
    private array $searchByFields = [];

    public function __construct(string $rawQuery)
    {
        $this->rawQuery = $rawQuery;
    }

    public static function forRawQuery(string $query): self
    {
        return new self($query);
    }

    public function useExactMatchingForIndividualWords(): self
    {
        $this->shouldUseExactMatchingForIndividualWords = true;

        return $this;
    }

    public function useWildcardMatching(): self
    {
        $this->shouldUseWildcardMatching = true;

        return $this;
    }

    public function searchByFields(string ...$fields): self
    {
        $this->searchByFields = $fields;

        return $this;
    }

    public function build(): QueryParameters
    {
        if (false === $this->shouldUseWildcardMatching && false === $this->shouldUseExactMatchingForIndividualWords) {
            return QueryParameters::usingLucene($this->escapeString($this->rawQuery));
        }

        $queryParts = [];
        $queryTokens = $this->filterOutEmptyElements(explode(' ', $this->rawQuery));

        foreach ($queryTokens as $queryToken) {
            $queryTokenParts = [];

            if (true === $this->shouldUseExactMatchingForIndividualWords) {
                $escapedQueryToken = $this->escapeString($queryToken);
                $queryTokenParts[] = $this->buildQueryForMatchPattern($escapedQueryToken, self::EXACT_MATCH_PATTERN);
            }

            if (true === $this->shouldUseWildcardMatching) {
                $queryTokenParts[] = $this->buildQueryPartWithWildcard($queryToken);
            }

            $queryParts[] = $this->joinPartsWithOperator($queryTokenParts, self::OPERATOR_OR);
        }

        return QueryParameters::usingLucene($this->joinPartsWithOperator($queryParts, self::OPERATOR_AND));
    }

    private function buildQueryForMatchPattern(string $queryToken, string $matchPattern): string
    {
        if (empty($this->searchByFields)) {
            return sprintf($matchPattern, $queryToken);
        }

        $matchPatternWithField = sprintf(
            '%s %s',
            self::SEARCH_FIELD_PATTERN,
            $matchPattern
        );
        $queryTokenParts = array_map(
            static fn (string $searchField) => sprintf($matchPatternWithField, $searchField, $queryToken),
            $this->searchByFields
        );

        return $this->joinPartsWithOperator($queryTokenParts, self::OPERATOR_OR);
    }

    private function joinPartsWithOperator(array $queryParts, string $operator): string
    {
        $queryParts = $this->filterOutEmptyElements($queryParts);

        return sprintf(
            count($queryParts) > 1 ? '(%s)' : '%s',
            implode(
                'OR' === $operator ? ' OR ' : ' AND ',
                $queryParts
            )
        );
    }

    private function buildQueryPartWithWildcard(string $queryToken): string
    {
        $hasAnyOfTheSpecialCharacters = strpbrk($queryToken, implode('', self::SPECIAL_CHARACTERS));

        if (false === $hasAnyOfTheSpecialCharacters) {
            return $this->buildQueryForMatchPattern($queryToken, self::WILDCARD_MATCH_PATTERN);
        }

        // Wildcard query is not tokenized on CloudSearch side, so we need to do it here to get accurate results.
        // Currently there is no spaces in $queryToken, so only special characters must be used to tokenize the query.
        // More details about this case:
        //  https://jaygurnaniblog.wordpress.com/2017/05/03/lucene-parsing-engine-in-aws-with-special-characters/
        $wildcardQueryTokens = explode(
            ' ',
            str_replace(self::SPECIAL_CHARACTERS, ' ', $queryToken)
        );
        $wildcardQueryTokens = $this->filterOutEmptyElements($wildcardQueryTokens);

        if (empty($wildcardQueryTokens)) {
            return '';
        }

        $wildcardQuery = implode(
            ' AND ',
            array_map(
                static fn(string $wildcardQueryToken) => sprintf(self::WILDCARD_MATCH_PATTERN, $wildcardQueryToken),
                $wildcardQueryTokens
            )
        );

        if (count($this->searchByFields) > 0) {
            $matchPatternWithField = sprintf(
                '%s (%s)',
                self::SEARCH_FIELD_PATTERN,
                $wildcardQuery
            );
            $queryTokenParts = array_map(
                static fn (string $searchField) => sprintf($matchPatternWithField, $searchField, $queryToken),
                $this->searchByFields
            );

            return $this->joinPartsWithOperator($queryTokenParts, self::OPERATOR_OR);
        }

        return $wildcardQuery;
    }

    private function escapeString(string $queryToken): string
    {
        // Backslash is more special character...
        return str_replace('\\', '\\\\', $queryToken);
    }

    private function filterOutEmptyElements(array $elements): array
    {
        return array_filter($elements, static fn (string $queryToken) => '' !== trim($queryToken));
    }
}
