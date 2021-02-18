<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Storage;

interface StorageClient
{
    /**
     * @return mixed
     */
    public function get(string $name);
    public function put(File $file): void;
}
