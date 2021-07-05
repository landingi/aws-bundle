<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\Query;

final class QueryParameters
{
    private const PARSER_LUCENE = 'lucene';
    private const PARSER_STRUCTURED = 'structured';

    private string $query;
    private string $parser;

    private function __construct(string $query, string $parser)
    {
        $this->query = $query;
        $this->parser = $parser;
    }

    public static function usingLucene(string $query): self
    {
        return new self($query, self::PARSER_LUCENE);
    }

    public static function matchAny(): self
    {
        return new self('matchall', self::PARSER_STRUCTURED);
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function getParser(): string
    {
        return $this->parser;
    }
}
