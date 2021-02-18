<?php
declare(strict_types=1);

namespace Landingi\Core\Storage;

interface StorageClient
{
    public function get(string $name);
    public function put(File $file): void;
}
