<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch;

use Aws\CloudSearchDomain\CloudSearchDomainClient;
use JsonException;
use Landingi\AwsBundle\Search\Document;
use Landingi\AwsBundle\Search\DocumentIdentifier;
use Landingi\AwsBundle\Search\SearchClient;

final class CloudSearch implements SearchClient
{
    private CloudSearchDomainClient $client;

    public function __construct(CloudSearchDomainClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws JsonException
     */
    public function upload(Document ...$documents): void
    {
        $this->uploadDocuments(
            array_map(
                static fn (Document $document) => [
                    'type' => 'add',
                    'id' => $document->getIdentifier()->getString(),
                    'fields' => $document->getFields(),
                ],
                $documents
            )
        );
    }

    /**
     * @throws JsonException
     */
    public function delete(DocumentIdentifier ...$documentIds): void
    {
        $this->uploadDocuments(
            array_map(
                static fn (DocumentIdentifier $documentId) => [
                    'type' => 'delete',
                    'id' => $documentId->toString(),
                ],
                $documentIds
            )
        );
    }

    /**
     * @throws JsonException
     */
    private function uploadDocuments(array $documents): void
    {
        $this->client->uploadDocuments([
            'contentType' => 'application/json',
            'documents' => json_encode($documents, JSON_THROW_ON_ERROR),
        ]);
    }
}
