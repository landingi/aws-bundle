<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Memory\Database;

use Landingi\AwsBundle\Database\KeyValueDatabaseClient;

final class MemoryKeyValueDatabaseClient implements KeyValueDatabaseClient
{
    public function get(array $key): array
    {
        // TODO: Implement get() method.
    }

    public function update(array $key, array $values): void
    {
        // TODO: Implement update() method.
    }

    public function delete(array $key): void
    {
        // TODO: Implement delete() method.
    }
}
