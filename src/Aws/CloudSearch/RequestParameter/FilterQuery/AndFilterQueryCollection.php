<?php
declare(strict_types=1);

namespace Landingi\AwsBundle\Aws\CloudSearch\RequestParameter\FilterQuery;

final class AndFilterQueryCollection extends FilterQueryCollection
{
    protected function getOperator(): string
    {
        return 'and';
    }
}
