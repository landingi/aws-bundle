<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database;

/**
 * Temporary PoC interface name - Find better for Key-Value Database/Storage.
 */
interface DatabaseClient
{
    public function getItem(string $tableName, array $key): array;
    public function updateItem(string $tableName, array $key, array $values): void;
}
