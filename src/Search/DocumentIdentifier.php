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

    public function toString(): string
    {
        return $this->identifier;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    public function equals(self $documentIdentifier): bool
    {
        return $this->identifier === $documentIdentifier->identifier;
    }
}
