<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Notification;

use JsonSerializable;

interface Message extends JsonSerializable
{
    public function getData(): array;
}
