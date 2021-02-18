<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Notification;

interface Message
{
    public function getData(): array;
}
