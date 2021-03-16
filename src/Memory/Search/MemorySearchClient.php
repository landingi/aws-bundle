<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Search;

use Landingi\AwsBundle\Search\Document;
use Landingi\AwsBundle\Search\DocumentIdentifier;
use Landingi\AwsBundle\Search\SearchClient;

final class MemorySearchClient implements SearchClient
{
    public function upload(Document ...$documents) : void
    {
        // TODO: Implement upload() method.
    }

    public function delete(DocumentIdentifier ...$documentIds) : void
    {
        // TODO: Implement delete() method.
    }
}
