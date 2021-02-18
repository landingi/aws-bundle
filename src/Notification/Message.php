<?php
declare(strict_types=1);

namespace Landingi\Core\Notification;

interface Message
{
    public function getData(): array;
}
