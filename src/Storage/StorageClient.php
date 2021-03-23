<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Storage;

interface StorageClient
{
    public function get(string $name): File;
    public function put(File $file): void;
}
