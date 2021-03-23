<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Storage;

use Countable;
use Landingi\AwsBundle\Storage\File;
use Landingi\AwsBundle\Storage\StorageClient;
use Landingi\AwsBundle\Storage\StorageException;
use function count;
use function sprintf;

final class MemoryStorageClient implements StorageClient, Countable
{
    /**
     * @var File[]
     */
    private array $memory = [];

    /**
     * @throws StorageException
     */
    public function get(string $name): File
    {
        foreach ($this->memory as $key => $file) {
            if ($file->getName() === $name) {
                return $file;
            }
        }

        throw new StorageException(
            sprintf('File for name (%s) not found', $name)
        );
    }

    public function put(File $file): void
    {
        $this->memory[] = $file;
    }

    public function count(): int
    {
        return count($this->memory);
    }
}
