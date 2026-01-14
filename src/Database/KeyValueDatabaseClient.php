<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database;

interface KeyValueDatabaseClient
{
    public function get(array $key): array;
    public function query(KeyCriteria $key, int $limit, ?string $indexName = null, ?ExactKeyCriteria $offsetKey = null): array;
    public function put(array $item): void;
    public function update(array $key, array $values): void;
    public function delete(array $key): void;
}
