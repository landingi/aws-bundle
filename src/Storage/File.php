<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Storage;

interface File
{
    public function getName(): string;

    public function getContent();
}
