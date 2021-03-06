<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\S3;

use Aws\S3\S3Client;
use DateTime;
use Landingi\AwsBundle\Storage\File;
use Landingi\AwsBundle\Storage\StorageClient;

final class S3Storage implements StorageClient
{
    private S3Client $client;
    private string $bucket;

    public function __construct(S3Client $client, string $bucket)
    {
        $this->client = $client;
        $this->bucket = $bucket;
    }

    public function get(string $name): File
    {
        return new S3File(
            $name,
            $this->client->getObject([
                'Bucket' => $this->bucket,
                'Key' => $name,
            ])->get('Body')
        );
    }

    public function getUrl(string $name, DateTime $expires): string
    {
        $cmd = $this->client->getCommand('GetObject', [
            'Bucket' => $this->bucket,
            'Key' => $name,
        ]);
        $request = $this->client->createPresignedRequest($cmd, $expires);

        return (string) $request->getUri();
    }

    public function put(File $file): void
    {
        $this->client->putObject([
            'Bucket' => $this->bucket,
            'Key' => $file->getName(),
            'Body' => $file->getContent(),
        ]);
    }
}
