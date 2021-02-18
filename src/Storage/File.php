<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Storage;

interface File
{
    public function getName(): string;

    /**
     * @return mixed
     */
    public function getContent();
}
