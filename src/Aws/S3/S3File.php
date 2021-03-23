<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\S3;

use Landingi\AwsBundle\Storage\File;

final class S3File implements File
{
    private string $name;
    private string $content;

    public function __construct(string $name, string $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
