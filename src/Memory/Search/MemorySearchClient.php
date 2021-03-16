<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Search;

use Countable;
use Landingi\AwsBundle\Search\Document;
use Landingi\AwsBundle\Search\DocumentIdentifier;
use Landingi\AwsBundle\Search\SearchClient;
use function count;

final class MemorySearchClient implements SearchClient, Countable
{
    /**
     * @var Document[]
     */
    private array $memory = [];

    public function upload(Document ...$documents): void
    {
        $this->memory = $documents;
    }

    public function delete(DocumentIdentifier $documentIdentifier): void
    {
        foreach ($this->memory as $key => $document) {
            if ($document->getIdentifier()->equals($documentIdentifier)) {
                unset($this->memory[$key]);
            }
        }
    }

    public function count(): int
    {
        return count($this->memory);
    }
}
