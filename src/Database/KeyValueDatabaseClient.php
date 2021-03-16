<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Database;

interface KeyValueDatabaseClient
{
    public function get(array $key): array;
    public function update(array $key, array $values): void;
    public function delete(array $key): void;
}
