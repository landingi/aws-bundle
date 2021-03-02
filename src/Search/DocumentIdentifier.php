<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Search;

final class DocumentIdentifier
{
    private string $identifier;

    public function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getString(): string
    {
        return $this->identifier;
    }
}
