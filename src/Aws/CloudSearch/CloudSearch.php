<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch;

use Aws\CloudSearch\CloudSearchClient;
use Landingi\AwsBundle\Search\Document;
use Landingi\AwsBundle\Search\DocumentIdentifier;
use Landingi\AwsBundle\Search\SearchClient;

final class CloudSearch implements SearchClient
{
    private CloudSearchClient $client;

    public function __construct(CloudSearchClient $client)
    {
        $this->client = $client;
    }

    public function upload(Document ...$documents) : void
    {
        // TODO: Implement upload() method.
    }

    public function delete(DocumentIdentifier ...$documentIds) : void
    {
        // TODO: Implement delete() method.
    }
}
