<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Storage;

use Countable;
use Landingi\AwsBundle\Storage\File;
use Landingi\AwsBundle\Storage\StorageClient;
use Landingi\AwsBundle\Storage\StorageException;
use function count;

final class MemoryStorageClient implements StorageClient, Countable
{
    /**
     * @var File[]
     */
    private array $memory = [];

    /**
     * @throws StorageException
     */
    public function get(string $name)
    {
        foreach ($this->memory as $key => $file) {
            if ($file->getName() === $name) {
                return $file;
            }
        }

        throw new StorageException('File not found');
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
